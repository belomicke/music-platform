<?php

declare(strict_types=1);

namespace App\Modules\Collection\Repositories;

use App\Modules\Auth\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class CollectionRepository
{
    public static function getFavoriteArtists(
        int $offset = 0,
        int $limit = 50
    ): Collection
    {
        $user = AuthService::user();

        $artists = $user
            ->followed_artists()
            ->wherePivot("is_deleted", false)
            ->orderByPivot(
                column: "created_at",
                direction: "desc"
            );

        if ($offset > 0) {
            $artists->skip(value: $offset);
        }

        return $artists
            ->take(value: $limit)
            ->get();
    }

    public static function getFavoriteReleases(
        int $offset = 0,
        int $limit = 50
    ): Collection
    {
        $user = AuthService::user();

        $releases = $user
            ->followed_releases()
            ->wherePivot("is_deleted", false)
            ->orderByPivot(
                column: "created_at",
                direction: "desc"
            );

        if ($offset > 0) {
            $releases->skip(value: $offset);
        }

        return $releases
            ->take(value: $limit)
            ->get();
    }

    public static function getFavoriteTracks(
        int $offset = 0,
        int $limit = 50
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

        if ($offset > 0) {
            $tracks->skip(value: $offset);
        }

        return $tracks
            ->take(value: $limit)
            ->get();
    }
}
