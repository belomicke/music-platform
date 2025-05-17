<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Repositories\CollectionRepository;

final readonly class GetFavoriteReleasesAction
{
    public function __construct(
        private CollectionRepository $collection
    ) {}

    public function execute(int $offset = 0): ReleaseMediaListDTO
    {
        return $this->collection->getFavoriteReleases(
            offset: $offset
        );
    }
}
