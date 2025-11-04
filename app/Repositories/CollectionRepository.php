<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\ArtistService;
use App\Services\AuthService;
use App\Services\ReleaseService;
use App\Services\TrackService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class CollectionRepository
{
    /**
     * @throws ArtistNotFoundException
     */
    public static function getFavoriteArtists(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        $user = AuthService::user();

        $artists = $user
            ->favorite_artists()
            ->wherePivot("is_deleted", false)
            ->orderByPivot(
                column: "id",
                direction: "desc"
            );

        if ($after) {
            $afterArtist = ArtistService::getByUuid(uuid: $after);

            $afterPivot = DB::table("artist_user")
                ->where("artist_id", $afterArtist->id)
                ->where("is_deleted", false)
                ->first();

            $artists = $artists
                ->wherePivot("id", "<", $afterPivot->id);
        }

        return $artists
            ->take(value: $limit)
            ->get();
    }

    /**
     * @throws ReleaseNotFoundException
     */
    public static function getFavoriteReleases(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        $user = AuthService::user();

        $releases = $user
            ->favorite_releases()
            ->wherePivot("is_deleted", false)
            ->orderByPivot(
                column: "id",
                direction: "desc"
            );

        if ($after) {
            $afterRelease = ReleaseService::getByUuid(uuid: $after);

            $afterPivot = DB::table("release_user")
                ->where("release_id", $afterRelease->id)
                ->where("is_deleted", false)
                ->first();

            $releases = $releases
                ->wherePivot("id", "<", $afterPivot->id);
        }

        return $releases
            ->take(value: $limit)
            ->get();
    }

    /**
     * @throws TrackNotFoundException
     */
    public static function getFavoriteTracks(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        $user = AuthService::user();

        $tracks = $user
            ->favorite_tracks()
            ->wherePivot("is_deleted", false)
            ->orderByPivot(
                column: "id",
                direction: "desc"
            );

        if ($after) {
            $afterRelease = TrackService::getByUuid(uuid: $after);

            $afterPivot = DB::table("track_user")
                ->where("track_id", $afterRelease->id)
                ->where("is_deleted", false)
                ->first();

            $tracks = $tracks
                ->wherePivot("id", "<", $afterPivot->id);
        }

        return $tracks
            ->take(value: $limit)
            ->get();
    }

    public static function isArtistInCollection(int $id): bool
    {
        $user = AuthService::user();

        if ($user === null) {
            return false;
        }

        return DB::table("artist_user")
            ->where("user_id", $user->id)
            ->where("artist_id", $id)
            ->where("is_deleted", false)
            ->exists();
    }

    public static function addArtistToCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("artist_user")->insert([
            "user_id" => $user->id,
            "artist_id" => $id,
            "is_deleted" => false,
            "updated_at" => now(),
            "created_at" => now(),
        ]);
    }

    public static function removeArtistFromCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("artist_user")
            ->where("user_id", $user->id)
            ->where("artist_id", $id)
            ->where("is_deleted", false)
            ->update([
                "is_deleted" => true,
                "updated_at" => now(),
            ]);
    }

    public static function isReleaseInCollection(int $id): bool
    {
        $user = AuthService::user();

        if ($user === null) {
            return false;
        }

        return DB::table("release_user")
            ->where("user_id", $user->id)
            ->where("release_id", $id)
            ->where("is_deleted", false)
            ->exists();
    }

    public static function addReleaseToCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("release_user")->insert([
            "user_id" => $user->id,
            "release_id" => $id,
            "is_deleted" => false,
            "updated_at" => now(),
            "created_at" => now(),
        ]);
    }

    public static function removeReleaseFromCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("release_user")
            ->where("user_id", $user->id)
            ->where("release_id", $id)
            ->where("is_deleted", false)
            ->update([
                "is_deleted" => true,
                "updated_at" => now(),
            ]);
    }

    public static function isTrackInCollection(int $id): bool
    {
        $user = AuthService::user();

        if ($user === null) {
            return false;
        }

        return DB::table("track_user")
            ->where("user_id", $user->id)
            ->where("track_id", $id)
            ->where("is_deleted", false)
            ->exists();
    }

    public static function addTrackToCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("track_user")->insert([
            "user_id" => $user->id,
            "track_id" => $id,
            "is_deleted" => false,
            "updated_at" => now(),
            "created_at" => now(),
        ]);
    }

    public static function removeTrackFromCollection(int $id): void
    {
        $user = AuthService::user();

        DB::table("track_user")
            ->where("user_id", $user->id)
            ->where("track_id", $id)
            ->where("is_deleted", false)
            ->update([
                "is_deleted" => true,
                "updated_at" => now(),
            ]);
    }
}
