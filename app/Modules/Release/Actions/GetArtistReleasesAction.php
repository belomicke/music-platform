<?php

declare(strict_types=1);

namespace App\Modules\Release\Actions;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Modules\Artist\Services\ArtistService;

final class GetArtistReleasesAction
{
    /**
     * @throws ArtistNotFoundException
     */
    public function execute(string $uuid): ReleaseMediaListDTO
    {
        $artist = ArtistService::getByUuid(
            uuid: $uuid,
            relations: [
                "releases",
                "releases.artists",
            ],
            relationsIfAuth: [
                "is_followed",
                "releases",
                "releases.is_followed",
                "releases.artists",
                "releases.artists.is_followed"
            ]
        );

        return new ReleaseMediaListDTO(
            releases: $artist->releases,
            count: $artist->release_count
        );
    }
}
