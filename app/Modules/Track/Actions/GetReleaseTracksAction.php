<?php

declare(strict_types=1);

namespace App\Modules\Track\Actions;

use App\DTOs\Track\TrackMediaListDTO;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\Track;
use App\Modules\Release\Service\ReleaseService;

final readonly class GetReleaseTracksAction
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function execute(string $uuid): TrackMediaListDTO
    {
        $release = ReleaseService::getByUuid(
            uuid: $uuid,
            relations: [
                "artists",
                "tracks",
                "tracks.artists"
            ],
            relationsIfAuth: [
                "is_followed",
                "artists.is_followed",
                "tracks.is_favorite",
                "tracks.artists.is_followed"
            ]
        );

        $tracks = $release->tracks;

        $tracks->each(function (Track $track) use ($release) {
            $track->release = $release;
        });

        return new TrackMediaListDTO(
            tracks: $tracks,
            count: $release->track_count
        );
    }
}
