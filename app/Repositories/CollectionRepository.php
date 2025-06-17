<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\DTOs\Release\ReleaseMediaListDTO;
use App\DTOs\Track\TrackMediaListDTO;
use App\Services\AuthService;
use App\Services\Cache\ArtistCacheService;
use App\Services\Cache\ReleaseCacheService;
use App\Services\Cache\TrackCacheService;

final class CollectionRepository
{
    public function getFavoriteArtists(
        int $offset = 0,
        int $limit = 50
    ): ArtistMediaListDTO
    {
        return ArtistCacheService::getFavoriteArtists(
            offset: $offset,
            limit: $limit,
            default: function () use ($offset, $limit) {
                $user = AuthService::user();

                $artists = $user
                    ->followed_artists()
                    ->orderByPivot(
                        column: "created_at",
                        direction: "desc"
                    );

                if ($offset > 0) {
                    $artists->skip(value: $offset);
                }

                $artists = $artists->take(value: $limit)->get();

                $result = new ArtistMediaListDTO(
                    artists: $artists,
                    count: $user->followed_artists_count
                );

                ArtistCacheService::setFavoriteArtists(
                    offset: $offset,
                    limit: $limit,
                    value: $result,
                );

                return $result;
            }
        );
    }

    public function getFavoriteReleases(
        int $offset = 0,
        int $limit = 50
    ): ReleaseMediaListDTO
    {
        $user = AuthService::user();

        return ReleaseCacheService::getFavoriteReleases(
            offset: $offset,
            limit: $limit,
            default: function () use ($user, $offset, $limit) {
                $releases = $user
                    ->followed_releases()
                    ->orderByPivot(
                        column: "created_at",
                        direction: "desc"
                    );

                if ($offset > 0) {
                    $releases->skip(value: $offset);
                }

                $releases = $releases->take(value: $limit)->get();

                $result = new ReleaseMediaListDTO(
                    releases: $releases,
                    count: $user->followed_releases_count
                );

                ReleaseCacheService::setFavoriteReleases(
                    offset: $offset,
                    limit: $limit,
                    value: $result,
                );

                return $result;
            }
        );
    }

    public function getFavoriteTracks(
        int $offset = 0,
        int $limit = 50
    ): TrackMediaListDTO
    {
        $user = AuthService::user();

        return TrackCacheService::getFavoriteTracks(
            offset: $offset,
            limit: $limit,
            default: function () use ($user, $offset, $limit) {
                $tracks = $user
                    ->favorite_tracks()
                    ->orderByPivot(
                        column: "id",
                        direction: "desc"
                    );

                if ($offset > 0) {
                    $tracks->skip(value: $offset);
                }

                $tracks = $tracks->take(value: $limit)->get();

                $result = new TrackMediaListDTO(
                    tracks: $tracks,
                    count: $user->favorite_tracks_count
                );

                TrackCacheService::setFavoriteTracks(
                    offset: $offset,
                    limit: $limit,
                    value: $result,
                );

                return $result;
            }
        );
    }
}
