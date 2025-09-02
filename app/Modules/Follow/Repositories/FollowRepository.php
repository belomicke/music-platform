<?php

declare(strict_types=1);

namespace App\Modules\Follow\Repositories;

use App\Modules\Auth\Services\AuthService;
use Illuminate\Support\Facades\DB;

final class FollowRepository
{
    public static function isFollowArtist(int $id): bool
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

    public static function followArtist(int $id): void
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

    public static function unfollowArtist(int $id): void
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

    public static function isFollowRelease(int $id): bool
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

    public static function followRelease(int $id): void
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

    public static function unfollowRelease(int $id): void
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

    public static function isTrackFavorite(int $id): bool
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

    public static function addTrackToFavorite(int $id): void
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

    public static function removeTrackFromFavoriteList(int $id): void
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
