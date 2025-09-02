<?php

declare(strict_types=1);

namespace App\Modules\Collection\Actions;

use App\DTOs\Collection\CollectionDTO;
use App\Modules\Collection\Services\CollectionService;

final readonly class GetCollectionAction
{
    public function execute(): CollectionDTO
    {
        $artists = CollectionService::getFavoriteArtists(limit: 12);
        $releases = CollectionService::getFavoriteReleases(limit: 12);
        $tracks = CollectionService::getFavoriteTracks(limit: 10);

        return new CollectionDTO(
            artists: $artists,
            releases: $releases,
            tracks: $tracks
        );
    }
}
