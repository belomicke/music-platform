<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Track;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class TrackRepository
{
    public static function getByUuid(string $uuid): Track|null
    {
        return Track::query()
            ->where("uuid", $uuid)
            ->first();
    }

    public static function search(
        string $query,
        int    $limit = 50,
        array  $relations = [],
        array  $relationsIfAuth = [],
    ): Collection
    {
        $tracks = Track::search(query: $query)
            ->take(limit: $limit)
            ->get();

        if (AuthService::check()) {
            $tracks->load(relations: array_merge(
                $relations,
                $relationsIfAuth)
            );
        } else {
            $tracks->load(relations: $relations);
        }

        return $tracks;
    }
}
