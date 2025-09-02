<?php

declare(strict_types=1);

namespace App\Modules\Release\Repositories;

use App\Models\Release;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class ReleaseRepository
{
    public static function getByUuid(string $uuid): Release|null
    {
        return Release::query()
            ->where('uuid', $uuid)
            ->first();
    }

    public static function exists(string $uuid): bool
    {
        return Release::query()
            ->where('uuid', $uuid)
            ->exists();
    }

    public static function getManyByUuid(array $uuids): Collection
    {
        return Release::query()
            ->whereIn('uuid', $uuids)
            ->get();
    }

    public static function search(
        string $query,
        int    $limit = 36,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Collection
    {
        $releases = Release::search(query: $query)
            ->take(limit: $limit)
            ->get();

        if (AuthService::check()) {
            $releases->load(relations: array_merge(
                $relations,
                $relationsIfAuth
            ));
        } else {
            $releases->load(relations: $relations);
        }

        return $releases;
    }

    public function getReleaseTrack(string $uuid, int $position): array
    {
        $release = ReleaseRepository::getByUuid(uuid: $uuid);

        $track = $release
            ->tracks()
            ->skip(value: $position - 1)
            ->first();

        return [
            $track,
            $release->track_count
        ];
    }
}
