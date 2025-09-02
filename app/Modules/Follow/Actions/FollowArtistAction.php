<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Artist\Services\ArtistService;
use App\Modules\Follow\Exceptions\ArtistAlreadyFollowedException;
use App\Modules\Follow\Service\FollowService;
use Illuminate\Support\Facades\DB;

final readonly class FollowArtistAction
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

            FollowService::followArtist(id: $artist->id);
            AccountService::incrementFollowedArtistsCount();

            DB::commit();
        } catch (ArtistAlreadyFollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
