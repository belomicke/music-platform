<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Track\TrackMediaListDTO;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\AuthService;
use App\Services\CollectionService;

final readonly class GetFavoriteTracksAction
{
    /**
     * @throws TrackNotFoundException
     */
    public function execute(string $after = ""): TrackMediaListDTO
    {
        $tracks = CollectionService::getFavoriteTracks(after: $after);
        $count = AuthService::user()->favorite_tracks_count;

        return new TrackMediaListDTO(
            tracks: $tracks,
            count: $count
        );
    }
}
