<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class AuthService
{
    public static function check(): bool
    {
        return Auth::guard("sanctum")->check();
    }

    public static function user(): User|null
    {
        return Auth::guard("sanctum")->user();
    }

    public static function incrementFollowedArtistsCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->followed_artists_count++;
        $user->save();
    }

    public static function decrementFollowedArtistsCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->followed_artists_count--;
        $user->save();
    }

    public static function incrementFollowedReleasesCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->followed_releases_count++;
        $user->save();
    }

    public static function decrementFollowedReleasesCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->followed_releases_count--;
        $user->save();
    }

    public static function incrementFavoriteTracksCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->favorite_tracks_count++;
        $user->save();
    }

    public static function decrementFavoriteTracksCount(): void
    {
        $user = Auth::guard("sanctum")->user();
        $user->favorite_tracks_count--;
        $user->save();
    }
}
