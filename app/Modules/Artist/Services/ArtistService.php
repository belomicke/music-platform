<?php

declare(strict_types=1);

namespace App\Modules\Artist\Services;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Models\Artist;
use App\Modules\Artist\Repositories\ArtistRepository;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class ArtistService
{
    /**
     * @throws ArtistNotFoundException
     */
    public static function getByUuid(
        string $uuid,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Artist
    {
        $artist = ArtistRepository::getByUuid(uuid: $uuid);

        if ($artist === null) {
            throw new ArtistNotFoundException();
        }

        if (AuthService::check()) {
            $artist = $artist->load(relations: array_merge(
                $relations,
                $relationsIfAuth
            ));
        } else {
            $artist = $artist->load(relations: $relations);
        }

        return $artist;
    }

    public static function exists(string $uuid): bool
    {
        return ArtistRepository::exists(uuid: $uuid);
    }

    /**
     * @return Collection<Artist>
     */
    public static function search(
        string $query,
        int    $limit = 12,
        array  $relationsIfAuth = []
    ): Collection
    {
        return ArtistRepository::search(
            query: $query,
            limit: $limit,
            relationsIfAuth: $relationsIfAuth
        );
    }
}
