<?php

declare(strict_types=1);

namespace App\DTOs\Collection;

use Illuminate\Database\Eloquent\Collection;

final class CollectionDTO
{
    public function __construct(
        public Collection $artists,
        public Collection $releases,
        public Collection $tracks,
    ) {}
}
