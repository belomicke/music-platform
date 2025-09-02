<?php

declare(strict_types=1);

namespace App\Modules\Track\Services;

use App\Exceptions\Track\TrackNotFoundException;
use App\Models\Track;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Track\Repositories\TrackRepository;
use Illuminate\Database\Eloquent\Collection;

final class TrackService
{
    /**
     * @throws TrackNotFoundException
     */
    public static function getByUuid(
        string $uuid,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Track|null
    {
        $track = TrackRepository::getByUuid(uuid: $uuid);

        if ($track === null) {
            throw new TrackNotFoundException();
        }

        if (AuthService::check()) {
            $track = $track->load(relations: array_merge(
                $relations,
                $relationsIfAuth
            ));
        } else {
            $track = $track->load(relations: $relations);
        }

        return $track;
    }

    /**
     * @return Collection<Track>
     */
    public static function search(
        string $query,
        int    $limit = 12,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Collection
    {
        return TrackRepository::search(
            query: $query,
            limit: $limit,
            relations: $relations,
            relationsIfAuth: $relationsIfAuth
        );
    }
}
