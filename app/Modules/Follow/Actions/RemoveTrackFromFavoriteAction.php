<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Track\TrackNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Follow\Exceptions\TrackAlreadyNotInFavoriteListException;
use App\Modules\Follow\Service\FollowService;
use App\Modules\Track\Services\TrackService;
use Illuminate\Support\Facades\DB;

final readonly class RemoveTrackFromFavoriteAction
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

            FollowService::removeTrackFromFavorite(id: $track->id);
            AccountService::decrementFavoriteTracksCount();

            DB::commit();
        } catch (TrackAlreadyNotInFavoriteListException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
