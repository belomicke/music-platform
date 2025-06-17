<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Track;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

final class TrackRepository
{
    public function getByUUID(string $uuid): Track|null
    {
        return Cache::get(key: "track:$uuid", default: function () use ($uuid) {
            $track = Track::query()
                ->where('uuid', $uuid)
                ->first();

            Cache::set(key: "track:$uuid", value: $track);

            return $track;
        });
    }

    public function search(
        string $query,
        array  $relations = [],
        int    $limit = 50
    ): Collection
    {
        $tracks = Track::search(query: $query)
            ->take(limit: $limit)
            ->get();

        if (count($relations) > 0) {
            $tracks->load(relations: $relations);
        }

        return $tracks;
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
