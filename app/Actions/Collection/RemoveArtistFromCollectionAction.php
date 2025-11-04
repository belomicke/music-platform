<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Collection\ArtistAlreadyUnfollowedException;
use App\Services\AccountService;
use App\Services\ArtistService;
use App\Services\CollectionService;
use Illuminate\Support\Facades\DB;

final readonly class RemoveArtistFromCollectionAction
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyUnfollowedException
     */
    public function execute(string $uuid): void
    {
        $artist = ArtistService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            CollectionService::removeArtistFromCollection(id: $artist->id);
            AccountService::decrementFollowedArtistsCount();

            DB::commit();
        } catch (ArtistAlreadyUnfollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
