<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\Release;
use App\Repositories\ReleaseRepository;
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

    /**
     * @throws ArtistNotFoundException
     */
    public static function getArtistReleases(
        string $uuid,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): ReleaseMediaListDTO
    {
        $artist = ArtistService::getByUuid(uuid: $uuid);

        $releases = ReleaseRepository::getArtistReleases(id: $artist->id);

        if (AuthService::check()) {
            $releases = $releases->load(relations: array_merge(
                $relations,
                $relationsIfAuth
            ));
        } else {
            $releases = $releases->load(relations: $relations);
        }

        return new ReleaseMediaListDTO(
            releases: $releases,
            count: $releases->count()
        );
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
