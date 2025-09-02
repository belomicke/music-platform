<?php

declare(strict_types=1);

namespace App\Modules\Release\Service;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\Release;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Release\Repositories\ReleaseRepository;
use Illuminate\Database\Eloquent\Collection;

final class ReleaseService
{
    /**
     * @throws ReleaseNotFoundException
     */
    public static function getByUuid(
        string $uuid,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Release|null
    {
        $release = ReleaseRepository::getByUuid(uuid: $uuid);

        if ($release === null) {
            throw new ReleaseNotFoundException();
        }

        if (AuthService::check()) {
            $release = $release->load(relations: array_merge(
                $relations,
                $relationsIfAuth
            ));
        } else {
            $release = $release->load(relations: $relations);
        }

        return $release;
    }

    public static function exists(string $uuid): bool
    {
        return ReleaseRepository::exists(uuid: $uuid);
    }

    public static function getManyByUuid(array $uuids): Collection
    {
        return ReleaseRepository::getManyByUuid(uuids: $uuids);
    }

    public static function search(
        string $query,
        int    $limit = 36,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Collection
    {
        return ReleaseRepository::search(
            query: $query,
            limit: $limit,
            relations: $relations,
            relationsIfAuth: $relationsIfAuth
        );
    }
}
