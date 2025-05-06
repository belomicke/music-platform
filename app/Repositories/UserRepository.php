<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\DTOs\User\CreateUserDTO;
use App\DTOs\User\UserMediaListDTO;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserRepository
{
    public function create(CreateUserDTO $data): User
    {
        $user = new User();

        $date = now();

        $user->uuid = Str::uuid()->toString();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make(value: $data->password);
        $user->email_verified_at = $date;
        $user->updated_at = $date;
        $user->created_at = $date;

        $user->save();

        return $user->fresh();
    }

    public function getByUUID(string $uuid): User|null
    {
        return User::query()->where('uuid', $uuid)->first();
    }

    public function getFollowedArtists(User $user, int $offset): ArtistMediaListDTO
    {
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

    public function getFollowedUsers(User $user, int $offset): UserMediaListDTO
    {
        $users = $user
            ->followed_users()
            ->orderByPivot(column: "created_at", direction: "desc");

        $count = $user->followed_users_count;

        if ($offset > 0) {
            $users->skip(value: $offset);
        }

        $users = $users->take(value: 50)->get();

        if (Auth::check()) {
            $users->load(relations: ["is_followed"]);
        }

        return new UserMediaListDTO(
            users: $users,
            count: $count
        );
    }

    public function getFollowers(User $user, int $offset): UserMediaListDTO
    {
        $users = $user
            ->followers()
            ->orderByPivot(column: "created_at", direction: "desc");

        $count = $user->followers_count;

        if ($offset > 0) {
            $users->skip(value: $offset);
        }

        $users = $users->take(value: 50)->get();

        if (Auth::check()) {
            $users->load(relations: ["is_followed"]);
        }

        return new UserMediaListDTO(
            users: $users,
            count: $count
        );
    }

    public function followArtist(Artist $artist): void
    {
        Auth::user()
            ->followed_artists()
            ->attach($artist);
    }

    public function unfollowArtist(Artist $artist): void
    {
        Auth::user()
            ->followed_artists()
            ->detach($artist);
    }

    public function followUser(User $user): void
    {
        Auth::user()
            ->followed_users()
            ->attach($user);
    }

    public function unfollowUser(User $user): void
    {
        Auth::user()
            ->followed_users()
            ->detach($user);
    }

    public function incrementFollowedArtistsCount(User $user): void
    {
        $user->followed_artists_count++;
        $user->save();
    }

    public function decrementFollowedArtistsCount(User $user): void
    {
        $user->followed_artists_count--;
        $user->save();
    }

    public function incrementFollowedUsersCount(User $user): void
    {
        $user->followed_users_count++;
        $user->save();
    }

    public function decrementFollowedUsersCount(User $user): void
    {
        $user->followed_users_count--;
        $user->save();
    }

    public function incrementFollowersCount(User $user): void
    {
        $user->followers_count++;
        $user->save();
    }

    public function decrementFollowersCount(User $user): void
    {
        $user->followers_count--;
        $user->save();
    }
}
