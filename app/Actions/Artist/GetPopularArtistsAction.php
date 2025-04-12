<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Collection;

final class GetPopularArtistsAction
{
    /* @return Collection<Artist> */
    public function execute(): Collection
    {
        return Artist::query()
            ->orderBy('popularity', 'desc')
            ->take(10)
            ->get();
    }
}
