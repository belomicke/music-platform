<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Track\TrackNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Follow\Exceptions\TrackAlreadyInFavoriteListException;
use App\Modules\Follow\Service\FollowService;
use App\Modules\Track\Services\TrackService;
use Illuminate\Support\Facades\DB;

final readonly class AddTrackToFavoriteAction
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

            FollowService::addTrackToFavorite(id: $track->id);
            AccountService::incrementFavoriteTracksCount();

            DB::commit();
        } catch (TrackAlreadyInFavoriteListException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
