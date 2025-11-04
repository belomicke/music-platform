<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Collection\TrackAlreadyInFavoriteListException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\AccountService;
use App\Services\CollectionService;
use App\Services\TrackService;
use Illuminate\Support\Facades\DB;

final readonly class AddTrackToCollectionAction
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyInFavoriteListException
     */
    public function execute(string $uuid): void
    {
        $track = TrackService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            CollectionService::addTrackToCollection(id: $track->id);
            AccountService::incrementFavoriteTracksCount();

            DB::commit();
        } catch (TrackAlreadyInFavoriteListException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
