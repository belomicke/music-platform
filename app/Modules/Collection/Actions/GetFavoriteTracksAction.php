<?php

declare(strict_types=1);

namespace App\Modules\Collection\Actions;

use App\DTOs\Track\TrackMediaListDTO;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Collection\Services\CollectionService;

final readonly class GetFavoriteTracksAction
{
    public function execute(int $offset = 0): TrackMediaListDTO
    {
        $tracks = CollectionService::getFavoriteTracks(offset: $offset);
        $count = AuthService::user()->favorite_tracks_count;

        return new TrackMediaListDTO(
            tracks: $tracks,
            count: $count
        );
    }
}
