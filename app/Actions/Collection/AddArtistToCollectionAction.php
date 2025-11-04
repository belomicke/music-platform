<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Collection\ArtistAlreadyFollowedException;
use App\Services\AccountService;
use App\Services\ArtistService;
use App\Services\CollectionService;
use Illuminate\Support\Facades\DB;

final readonly class AddArtistToCollectionAction
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyFollowedException
     */
    public function execute(string $uuid): void
    {
        $artist = ArtistService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            CollectionService::addArtistToCollection(id: $artist->id);
            AccountService::incrementFollowedArtistsCount();

            DB::commit();
        } catch (ArtistAlreadyFollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
