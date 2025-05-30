<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\User\CreateUserDTO;
use App\Models\User;
use App\Services\AuthService;
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

    public function incrementFavoriteTracksCount(): void
    {
        $user = AuthService::user();

        $user->favorite_tracks_count++;
        $user->save();
    }

    public function decrementFavoriteTracksCount(): void
    {
        $user = AuthService::user();

        $user->favorite_tracks_count--;
        $user->save();
    }
}
