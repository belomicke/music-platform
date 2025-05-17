<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Collection\CollectionDTO;
use App\Repositories\CollectionRepository;

final readonly class GetCollectionAction
{
    public function __construct(
        private CollectionRepository $collection,
    ) {}

    public function execute(): CollectionDTO
    {
        $artists = $this->collection->getFavoriteArtists(limit: 12);
        $releases = $this->collection->getFavoriteReleases(limit: 12);

        return new CollectionDTO(
            artists: $artists,
            releases: $releases
        );
    }
}
