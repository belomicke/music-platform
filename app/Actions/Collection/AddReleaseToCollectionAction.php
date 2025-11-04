<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\Exceptions\Collection\ReleaseAlreadyFollowedException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Services\AccountService;
use App\Services\CollectionService;
use App\Services\ReleaseService;
use Illuminate\Support\Facades\DB;

final readonly class AddReleaseToCollectionAction
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

            CollectionService::addReleaseToCollection(id: $release->id);
            AccountService::incrementFollowedReleasesCount();

            DB::commit();
        } catch (ReleaseAlreadyFollowedException $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
