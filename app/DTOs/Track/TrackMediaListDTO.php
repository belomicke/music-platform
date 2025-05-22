<?php

declare(strict_types=1);

namespace App\DTOs\Track;

use Illuminate\Database\Eloquent\Collection;

final class TrackMediaListDTO
{
    public function __construct(
        public Collection $tracks,
        public int        $count
    ) {}
}
