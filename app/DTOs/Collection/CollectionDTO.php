<?php

declare(strict_types=1);

namespace App\DTOs\Collection;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\DTOs\Release\ReleaseMediaListDTO;

final class CollectionDTO
{
    public function __construct(
        public ArtistMediaListDTO  $artists,
        public ReleaseMediaListDTO $releases,
    ) {}
}
