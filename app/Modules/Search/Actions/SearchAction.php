<?php

declare(strict_types=1);

namespace App\Modules\Search\Actions;

use App\Modules\Artist\Services\ArtistService;
use App\Modules\Release\Service\ReleaseService;
use App\Modules\Search\DTOs\SearchResultDTO;
use App\Modules\Track\Services\TrackService;

final readonly class SearchAction
{
    public function execute(string $query): SearchResultDTO
    {
        $artists = ArtistService::search(
            query: $query,
            limit: 9,
            relationsIfAuth: [
                "is_followed"
            ]
        );

        $releases = ReleaseService::search(
            query: $query,
            limit: 9,
            relations: [
                "artists"
            ],
            relationsIfAuth: [
                "is_followed",
                "artists.is_followed"
            ]
        );

        $tracks = TrackService::search(
            query: $query,
            limit: 8,
            relations: [
                "artists",
                "release",
                "release.artists"
            ],
            relationsIfAuth: [
                "artists.is_followed",
                "release.is_followed",
                "release.artists.is_followed"
            ]
        );

        return new SearchResultDTO(
            artists: $artists,
            releases: $releases,
            tracks: $tracks
        );
    }
}
