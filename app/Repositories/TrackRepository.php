<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Track;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class TrackRepository
{
    public function search(string $query, int $limit = 50): Collection
    {
        return Track::search(query: $query)
            ->take(limit: $limit)
            ->get();
    }

    public function addToFavorite(Track $track): void
    {
        AuthService::user()
            ->favorite_tracks()
            ->attach($track);
    }

    public function removeFromFavorite(Track $track): void
    {
        AuthService::user()
            ->favorite_tracks()
            ->detach($track);
    }
}
