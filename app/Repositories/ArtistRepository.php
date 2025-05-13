<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class ArtistRepository
{
    public function getByUUID(string $uuid): Artist|null
    {
        return Artist::query()->where('uuid', $uuid)->first();
    }

    public function getPopular(): ArtistMediaListDTO
    {
        $artists = Artist::query()
            ->orderBy(column: "id", direction: "desc")
            ->take(value: 12)
            ->get();

        $count = Artist::query()->count();

        if (Auth::check()) {
            $artists->load(relations: ["is_followed"]);
        }

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }

    public function search(string $query, int $limit = 36): Collection
    {
        return Artist::search(query: $query)->take(limit: $limit)->get();
    }

    public function incrementFollowersCount(Artist $artist): void
    {
        $artist->followers_count++;
        $artist->save();
    }

    public function decrementFollowersCount(Artist $artist): void
    {
        $artist->followers_count--;
        $artist->save();
    }
}
