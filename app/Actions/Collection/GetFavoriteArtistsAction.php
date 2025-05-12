<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Repositories\CollectionRepository;

final readonly class GetFavoriteArtistsAction
{
    public function __construct(
        private CollectionRepository $collection
    ) {}

    public function execute(int $offset = 0): ArtistMediaListDTO
    {
        return $this->collection->getFavoriteArtists(
            offset: $offset
        );
    }
}
