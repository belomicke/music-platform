<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Collection\ArtistAlreadyFollowedException;
use App\Exceptions\Collection\ArtistAlreadyUnfollowedException;
use App\Exceptions\Collection\ReleaseAlreadyFollowedException;
use App\Exceptions\Collection\ReleaseAlreadyUnfollowedException;
use App\Exceptions\Collection\TrackAlreadyInFavoriteListException;
use App\Exceptions\Collection\TrackAlreadyNotInFavoriteListException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Repositories\CollectionRepository;
use Illuminate\Database\Eloquent\Collection;

final class CollectionService
{
    /**
     * @throws ArtistNotFoundException
     */
    public static function getFavoriteArtists(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteArtists(
            after: $after,
            limit: $limit
        );
    }

    /**
     * @throws ReleaseNotFoundException
     */
    public static function getFavoriteReleases(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteReleases(
            after: $after,
            limit: $limit
        );
    }

    /**
     * @throws TrackNotFoundException
     */
    public static function getFavoriteTracks(
        string $after = "",
        int    $limit = 50
    ): Collection
    {
        return CollectionRepository::getFavoriteTracks(
            after: $after,
            limit: $limit
        );
    }

    /**
     * @throws ArtistAlreadyFollowedException
     */
    public static function addArtistToCollection(int $id): void
    {
        $exists = CollectionRepository::isArtistInCollection(id: $id);

        if ($exists) {
            throw new ArtistAlreadyFollowedException();
        }

        CollectionRepository::addArtistToCollection(id: $id);
    }

    /**
     * @throws ArtistAlreadyUnfollowedException
     */
    public static function removeArtistFromCollection(int $id): void
    {
        $exists = CollectionRepository::isArtistInCollection(id: $id);

        if ($exists === false) {
            throw new ArtistAlreadyUnfollowedException();
        }

        CollectionRepository::removeArtistFromCollection(id: $id);
    }

    /**
     * @throws ReleaseAlreadyFollowedException
     */
    public static function addReleaseToCollection(int $id): void
    {
        $exists = CollectionRepository::isReleaseInCollection(id: $id);

        if ($exists) {
            throw new ReleaseAlreadyFollowedException();
        }

        CollectionRepository::addReleaseToCollection(id: $id);
    }

    /**
     * @throws ReleaseAlreadyUnfollowedException
     */
    public static function removeReleaseFromCollection(int $id): void
    {
        $exists = CollectionRepository::isReleaseInCollection(id: $id);

        if ($exists === false) {
            throw new ReleaseAlreadyUnfollowedException();
        }

        CollectionRepository::removeReleaseFromCollection(id: $id);
    }

    /**
     * @throws TrackAlreadyInFavoriteListException
     */
    public static function addTrackToCollection(int $id): void
    {
        $isFavorite = CollectionRepository::isTrackInCollection(id: $id);

        if ($isFavorite === true) {
            throw new TrackAlreadyInFavoriteListException();
        }

        CollectionRepository::addTrackToCollection(id: $id);
    }

    /**
     * @throws TrackAlreadyNotInFavoriteListException
     */
    public static function removeTrackFromCollection(int $id): void
    {
        $isFavorite = CollectionRepository::isTrackInCollection(id: $id);

        if ($isFavorite === false) {
            throw new TrackAlreadyNotInFavoriteListException();
        }

        CollectionRepository::removeTrackFromCollection(id: $id);
    }
}
