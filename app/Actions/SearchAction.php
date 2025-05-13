<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\ArtistRepository;

final readonly class SearchAction
{
    public function __construct(
        private ArtistRepository $artists
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

        return [
            "artists" => $artists,
        ];
    }
}
