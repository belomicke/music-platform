<?php

declare(strict_types=1);

namespace App\Modules\Follow\Actions;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Modules\Account\Services\AccountService;
use App\Modules\Follow\Exceptions\ReleaseAlreadyFollowedException;
use App\Modules\Follow\Service\FollowService;
use App\Modules\Release\Service\ReleaseService;
use Illuminate\Support\Facades\DB;

final readonly class FollowReleaseAction
{
    /**
     * @throws ReleaseNotFoundException
     * @throws ReleaseAlreadyFollowedException
     */
    public function execute(string $uuid): void
    {
        $release = ReleaseService::getByUuid(uuid: $uuid);

        try {
            DB::beginTransaction();

            FollowService::followRelease(id: $release->id);
            AccountService::incrementFollowedReleasesCount();

            DB::commit();
        } catch (ReleaseAlreadyFollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
