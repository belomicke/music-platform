<?php

declare(strict_types=1);

namespace App\DTOs\Artist;

use App\Models\Artist;
use Illuminate\Support\Collection;

final class ArtistMediaListDTO
{
    /**
     * @var Collection<Artist> $artists
     */
    public function __construct(
        public Collection $artists,
        public int        $count
    ) {}
}
