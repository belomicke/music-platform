<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\DTOs\Track\TrackMediaListDTO;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

final class TrackCacheService
{
    public static function getIsFavorite(int $id, mixed $default = null): bool
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:track:$id:is-favorite",
            default: $default
        );
    }

    public static function setIsFavorite(int $id, bool $value, int $ttl = 3600): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:track:$id:is-favorite",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getArtists(string $id, mixed $default = null): Collection
    {
        return Cache::get(
            key: "track:$id:artists",
            default: $default
        );
    }

    public static function setArtists(string $id, Collection $value, int $ttl = 3600): void
    {
        Cache::set(
            key: "track:$id:artists",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getReleases(string $id, mixed $default = null): Collection
    {
        return Cache::get(
            key: "track:$id:releases",
            default: $default
        );
    }

    public static function setReleases(string $id, Collection $value, int $ttl = 3600): void
    {
        Cache::set(
            key: "track:$id:releases",
            value: $value,
            ttl: $ttl
        );
    }

    public static function getFavoriteTracks(
        int   $offset,
        int   $limit,
        mixed $default = null
    ): TrackMediaListDTO
    {
        $user = AuthService::user();

        return Cache::get(
            key: "user:$user->id:favorite-tracks:offset:$offset:limit:$limit",
            default: $default
        );
    }

    public static function setFavoriteTracks(
        int               $offset,
        int               $limit,
        TrackMediaListDTO $value,
        int               $ttl = 3600
    ): void
    {
        $user = AuthService::user();

        Cache::set(
            key: "user:$user->id:favorite-tracks:offset:$offset:limit:$limit",
            value: $value,
            ttl: $ttl
        );
    }

    public static function clearFavoriteTracks(): void
    {
        $user = AuthService::user();

        $keys = Redis::command(
            method: "keys",
            parameters: [
                "laravel_cache_user:$user->id:favorite-tracks:*",
            ]
        );

        foreach ($keys as $key) {
            $result = str_replace(
                search: "laravel_database_laravel_cache_",
                replace: "",
                subject: $key
            );

            Cache::forget(key: $result);
        }
    }
}
