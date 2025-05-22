<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\ArtistRepository;
use App\Repositories\ReleaseRepository;
use App\Repositories\TrackRepository;

final readonly class SearchAction
{
    public function __construct(
        private ArtistRepository  $artists,
        private ReleaseRepository $releases,
        private TrackRepository   $tracks
    ) {}

    public function execute(
        string $query,
        string $type
    ): array
    {
        $artists = $this->artists->search(
            query: $query,
            limit: $type === "artists" ? 36 : 9
        );

        $releases = $this->releases->search(
            query: $query,
            limit: $type === "releases" ? 36 : 9
        );

        $tracks = $this->tracks->search(
            query: $query,
            limit: $type === "tracks" ? 50 : 8
        );

        return [
            "artists" => $artists,
            "releases" => $releases,
            "tracks" => $tracks
        ];
    }
}
