<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use Illuminate\Support\Facades\Auth;

final class CollectionRepository
{
    public function getFavoriteArtists(int $offset): ArtistMediaListDTO
    {
        $user = Auth::user();

        $artists = $user
            ->followed_artists()
            ->orderByPivot(column: "created_at", direction: "desc");

        $count = $user->followed_artists_count;

        if ($offset > 0) {
            $artists->skip(value: $offset);
        }

        $artists = $artists->take(value: 50)->get();

        if (Auth::check()) {
            $artists->load(relations: ["is_followed"]);
        }

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }
}
