<?php

declare(strict_types=1);

namespace App\Modules\Collection\Services;

use App\Modules\Collection\Repositories\CollectionRepository;
use Illuminate\Database\Eloquent\Collection;

final class CollectionService
{
    public static function getFavoriteArtists(
        int $offset = 0,
        int $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteArtists(
            offset: $offset,
            limit: $limit
        );
    }

    public static function getFavoriteReleases(
        int $offset = 0,
        int $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteReleases(
            offset: $offset,
            limit: $limit
        );
    }

    public static function getFavoriteTracks(
        int $offset = 0,
        int $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteTracks(
            offset: $offset,
            limit: $limit
        );
    }
}
