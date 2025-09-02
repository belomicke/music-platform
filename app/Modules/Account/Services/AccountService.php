<?php

declare(strict_types=1);

namespace App\Modules\Account\Services;

use App\Modules\Auth\Services\AuthService;

final class AccountService
{
    public static function incrementFollowedArtistsCount(): void
    {
        $user = AuthService::user();
        $user->followed_artists_count++;
        $user->save();
    }

    public static function decrementFollowedArtistsCount(): void
    {
        $user = AuthService::user();
        $user->followed_artists_count--;
        $user->save();
    }

    public static function incrementFollowedReleasesCount(): void
    {
        $user = AuthService::user();
        $user->followed_releases_count++;
        $user->save();
    }

    public static function decrementFollowedReleasesCount(): void
    {
        $user = AuthService::user();
        $user->followed_releases_count--;
        $user->save();
    }

    public static function incrementFavoriteTracksCount(): void
    {
        $user = AuthService::user();
        $user->favorite_tracks_count++;
        $user->save();
    }

    public static function decrementFavoriteTracksCount(): void
    {
        $user = AuthService::user();
        $user->favorite_tracks_count--;
        $user->save();
    }
}
