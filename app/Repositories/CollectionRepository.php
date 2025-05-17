<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\DTOs\Release\ReleaseMediaListDTO;
use App\Services\AuthService;

final class CollectionRepository
{
    public function getFavoriteArtists(
        int $offset = 0,
        int $limit = 50
    ): ArtistMediaListDTO
    {
        $user = AuthService::user();

        $artists = $user
            ->followed_artists()
            ->orderByPivot(
                column: "created_at",
                direction: "desc"
            );

        $count = $user->followed_artists_count;

        if ($offset > 0) {
            $artists->skip(value: $offset);
        }

        $artists = $artists->take(value: $limit)->get();

        if (AuthService::check()) {
            $artists->load(relations: ["is_followed"]);
        }

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }

    public function getFavoriteReleases(
        int $offset = 0,
        int $limit = 50
    ): ReleaseMediaListDTO
    {
        $user = AuthService::user();

        $releases = $user
            ->followed_releases()
            ->orderByPivot(
                column: "created_at",
                direction: "desc"
            );

        $count = $user->followed_releases()->count();

        if ($offset > 0) {
            $releases->skip(value: $offset);
        }

        $releases = $releases->take(value: $limit)->get();

        if (AuthService::check()) {
            $releases->load(relations: ["is_followed"]);
        }

        return new ReleaseMediaListDTO(
            releases: $releases,
            count: $count
        );
    }
}
