<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Track\TrackMediaListDTO;
use App\Repositories\CollectionRepository;

final readonly class GetFavoriteTracksAction
{
    public function __construct(
        private CollectionRepository $collection
    ) {}

    public function execute(int $offset = 0): TrackMediaListDTO
    {
        return $this->collection->getFavoriteTracks(offset: $offset);
    }
}
