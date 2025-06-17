<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ReleaseCacheService
{
    public static function getIsFollowed(int $id, mixed $default = null): bool
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:release:$id:is-followed",
            default: $default
        );
    }

    public static function setIsFollowed(int $id, bool $value, int $ttl = 3600): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:release:$id:is-followed",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getArtists(string $id, mixed $default = null): Collection
    {
        return Cache::get(
            key: "release:$id:artists",
            default: $default
        );
    }

    public static function setArtists(string $id, Collection $value, int $ttl = 3600): void
    {
        Cache::set(
            key: "release:$id:artists",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getTracks(string $id, mixed $default = null): Collection
    {
        return Cache::get(
            key: "release:$id:tracks",
            default: $default
        );
    }

    public static function setTracks(string $id, Collection $value, int $ttl = 3600): void
    {
        Cache::set(
            key: "release:$id:tracks",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getFavoriteReleases(
        int   $offset,
        int   $limit,
        mixed $default = null
    ): ReleaseMediaListDTO
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:favorite-releases:offset:$offset:limit:$limit",
            default: $default
        );
    }

    public static function setFavoriteReleases(
        int                 $offset,
        int                 $limit,
        ReleaseMediaListDTO $value,
        int                 $ttl = 3600
    ): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:favorite-releases:offset:$offset:limit:$limit",
            value: $value,
            ttl: $ttl
        );
    }
}
