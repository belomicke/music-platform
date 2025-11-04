<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Collection\CollectionDTO;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\CollectionService;

final readonly class GetCollectionAction
{
    /**
     * @throws ArtistNotFoundException
     * @throws ReleaseNotFoundException
     * @throws TrackNotFoundException
     */
    public function execute(): CollectionDTO
    {
        $tracks = CollectionService::getFavoriteTracks(limit: 10);
        $artists = CollectionService::getFavoriteArtists(limit: 12);
        $releases = CollectionService::getFavoriteReleases(limit: 12);

        return new CollectionDTO(
            tracks: $tracks,
            artists: $artists,
            releases: $releases,
        );
    }
}
