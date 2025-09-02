<?php

declare(strict_types=1);

namespace App\Modules\Follow\Service;

use App\Modules\Follow\Exceptions\ArtistAlreadyFollowedException;
use App\Modules\Follow\Exceptions\ArtistAlreadyUnfollowedException;
use App\Modules\Follow\Exceptions\ReleaseAlreadyFollowedException;
use App\Modules\Follow\Exceptions\ReleaseAlreadyUnfollowedException;
use App\Modules\Follow\Exceptions\TrackAlreadyInFavoriteListException;
use App\Modules\Follow\Exceptions\TrackAlreadyNotInFavoriteListException;
use App\Modules\Follow\Repositories\FollowRepository;

final class FollowService
{
    /**
     * @throws ArtistAlreadyFollowedException
     */
    public static function followArtist(int $id): void
    {
        $exists = FollowRepository::isFollowArtist(id: $id);

        if ($exists) {
            throw new ArtistAlreadyFollowedException();
        }

        FollowRepository::followArtist(id: $id);
    }

    /**
     * @throws ArtistAlreadyUnfollowedException
     */
    public static function unfollowArtist(int $id): void
    {
        $exists = FollowRepository::isFollowArtist(id: $id);

        if ($exists === false) {
            throw new ArtistAlreadyUnfollowedException();
        }

        FollowRepository::unfollowArtist(id: $id);
    }

    /**
     * @throws ReleaseAlreadyFollowedException
     */
    public static function followRelease(int $id): void
    {
        $exists = FollowRepository::isFollowRelease(id: $id);

        if ($exists) {
            throw new ReleaseAlreadyFollowedException();
        }

        FollowRepository::followRelease(id: $id);
    }

    /**
     * @throws ReleaseAlreadyUnfollowedException
     */
    public static function unfollowRelease(int $id): void
    {
        $exists = FollowRepository::isFollowRelease(id: $id);

        if ($exists === false) {
            throw new ReleaseAlreadyUnfollowedException();
        }

        FollowRepository::unfollowRelease(id: $id);
    }

    /**
     * @throws TrackAlreadyInFavoriteListException
     */
    public static function addTrackToFavorite(int $id): void
    {
        $isFavorite = FollowRepository::isTrackFavorite(id: $id);

        if ($isFavorite === true) {
            throw new TrackAlreadyInFavoriteListException();
        }

        FollowRepository::addTrackToFavorite(id: $id);
    }

    /**
     * @throws TrackAlreadyNotInFavoriteListException
     */
    public static function removeTrackFromFavorite(int $id): void
    {
        $isFavorite = FollowRepository::isTrackFavorite(id: $id);

        if ($isFavorite === false) {
            throw new TrackAlreadyNotInFavoriteListException();
        }

        FollowRepository::removeTrackFromFavoriteList(id: $id);
    }
}
