<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Services\AuthService;
use Illuminate\Support\Facades\Cache;

final class ArtistCacheService
{
    public static function getIsFollowed(
        int   $id,
        mixed $default = null
    ): bool
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:artist:$id:is-followed",
            default: $default
        );
    }

    public static function setIsFollowed(
        int  $id,
        bool $value,
        int  $ttl = 3600
    ): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:artist:$id:is-followed",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getFavoriteArtists(
        int   $offset,
        int   $limit,
        mixed $default = null
    ): ArtistMediaListDTO
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:favorite-artists:offset:$offset:limit:$limit",
            default: $default
        );
    }

    public static function setFavoriteArtists(
        int                $offset,
        int                $limit,
        ArtistMediaListDTO $value,
        int                $ttl = 3600
    ): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:favorite-artists:offset:$offset:limit:$limit",
            value: $value,
            ttl: $ttl
        );
    }
}
