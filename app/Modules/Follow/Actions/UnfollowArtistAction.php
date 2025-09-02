<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Artist\Services\ArtistService;
use App\Modules\Follow\Exceptions\ArtistAlreadyUnfollowedException;
use App\Modules\Follow\Service\FollowService;
use Illuminate\Support\Facades\DB;

final readonly class UnfollowArtistAction
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

            FollowService::unfollowArtist(id: $artist->id);
            AccountService::decrementFollowedArtistsCount();

            DB::commit();
        } catch (ArtistAlreadyUnfollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
