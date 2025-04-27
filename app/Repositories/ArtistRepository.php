<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class ArtistRepository
{
    public function getPopular(): ArtistMediaListDTO
    {
        $artists = Artist::query()
            ->orderBy(column: "popularity", direction: "desc")
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

    public function getUserFollowed(User $user, int $offset): ArtistMediaListDTO
    {
        $artists = $user
            ->followed_artists()
            ->orderByPivot(column: "created_at", direction: "desc")
            ->skip(value: $offset)
            ->take(value: 1000)
            ->get();

        $count = $user
            ->followed_artists()
            ->count();

        if (Auth::check()) {
            $artists->load(relations: ["is_followed"]);
        }

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }

    public function follow(int $id): void
    {
        Auth::user()
            ->followed_artists()
            ->attach($id);
    }

    public function unfollow(int $id): void
    {
        Auth::user()
            ->followed_artists()
            ->detach($id);
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
