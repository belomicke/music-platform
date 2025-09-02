<?php

declare(strict_types=1);

namespace App\Modules\Search\DTOs;

use App\Models\Artist;
use App\Models\Release;
use App\Models\Track;
use Illuminate\Database\Eloquent\Collection;

final class SearchResultDTO
{
    /**
     * @param Collection<Artist> $artists
     * @param Collection<Release> $releases
     * @param Collection<Track> $tracks
     */
    public function __construct(
        public Collection $artists,
        public Collection $releases,
        public Collection $tracks,
    ) {}
}
