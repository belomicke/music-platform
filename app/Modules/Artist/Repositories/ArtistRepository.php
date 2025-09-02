<?php

declare(strict_types=1);

namespace App\Modules\Artist\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Models\Artist;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class ArtistRepository
{
    public static function getByUuid(string $uuid): Artist|null
    {
        return Artist::query()
            ->where("uuid", $uuid)
            ->first();
    }

    public static function exists(string $uuid): bool
    {
        return Artist::query()
            ->where("uuid", $uuid)
            ->exists();
    }

    public static function getManyByUuid(array $uuids): Collection
    {
        return Artist::query()->whereIn('uuid', $uuids)->get();
    }

    public static function getPopular(): ArtistMediaListDTO
    {
        $artists = Artist::query()
            ->orderBy(column: "id", direction: "asc")
            ->take(value: 12)
            ->get();

        $count = Artist::query()->count();

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }

    public static function search(
        string $query,
        int    $limit = 36,
        array  $relations = [],
        array  $relationsIfAuth = []
    ): Collection
    {
        $artists = Artist::search(query: $query)
            ->take(limit: $limit)
            ->get();

        if (AuthService::check()) {
            $artists->load(relations: array_merge(
                $relations,
                $relationsIfAuth,
            ));
        } else {
            $artists->load(relations: $relations);
        }

        return $artists;
    }
}
