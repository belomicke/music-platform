<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Collection\ReleaseAlreadyUnfollowedException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Services\AccountService;
use App\Services\CollectionService;
use App\Services\ReleaseService;
use Illuminate\Support\Facades\DB;

final readonly class RemoveReleaseFromCollectionAction
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

            CollectionService::removeReleaseFromCollection(id: $release->id);
            AccountService::decrementFollowedReleasesCount();

            DB::commit();
        } catch (ReleaseAlreadyUnfollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
