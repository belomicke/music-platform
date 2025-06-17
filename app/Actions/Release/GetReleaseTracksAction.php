<?php

declare(strict_types=1);

namespace App\Actions\Release;

use App\DTOs\Track\TrackMediaListDTO;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Repositories\ReleaseRepository;

final readonly class GetReleaseTracksAction
{
    public function __construct(
        private ReleaseRepository $releases
    ) {}

    /**
     * @throws ReleaseNotFoundException
     */
    public function execute(string $uuid): TrackMediaListDTO
    {
        $release = $this->releases->getByUUID(uuid: $uuid);

        if ($release === null) {
            throw new ReleaseNotFoundException();
        }

        $tracks = $this->releases->getTracks(uuid: $uuid);

        return new TrackMediaListDTO(
            tracks: $tracks,
            count: $release->track_count
        );
    }
}
