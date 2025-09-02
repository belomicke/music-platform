<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Follow\Exceptions\ReleaseAlreadyUnfollowedException;
use App\Modules\Follow\Service\FollowService;
use App\Modules\Release\Service\ReleaseService;
use Illuminate\Support\Facades\DB;

final readonly class UnfollowReleaseAction
{
    /**
     * @throws ReleaseNotFoundException
     * @throws ReleaseAlreadyUnfollowedException
     */
    public function execute(string $uuid): void
    {
        $release = ReleaseService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            FollowService::unfollowRelease(id: $release->id);
            AccountService::decrementFollowedReleasesCount();

            DB::commit();
        } catch (ReleaseAlreadyUnfollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
