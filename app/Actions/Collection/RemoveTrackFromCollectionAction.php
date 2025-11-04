<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Collection\TrackAlreadyNotInFavoriteListException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\AccountService;
use App\Services\CollectionService;
use App\Services\TrackService;
use Illuminate\Support\Facades\DB;

final readonly class RemoveTrackFromCollectionAction
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyNotInFavoriteListException
     */
    public function execute(string $uuid): void
    {
        $track = TrackService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            CollectionService::removeTrackFromCollection(id: $track->id);
            AccountService::decrementFavoriteTracksCount();

            DB::commit();
        } catch (TrackAlreadyNotInFavoriteListException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
