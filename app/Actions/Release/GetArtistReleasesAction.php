<?php

declare(strict_types=1);

namespace App\Actions\Release;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Services\ReleaseService;

final class GetArtistReleasesAction
{
    /**
     * @throws ArtistNotFoundException
     */
    public function execute(string $uuid): ReleaseMediaListDTO
    {
        $releases = ReleaseService::getArtistReleases(
            uuid: $uuid,
            relations: [
                "artists",
            ],
            relationsIfAuth: [
                "is_followed",
                "artists",
                "artists.is_followed"
            ]
        );

        return new ReleaseMediaListDTO(
            releases: $releases->releases,
            count: $releases->count
        );
    }
}
