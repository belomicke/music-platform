<?php

declare(strict_types=1);

namespace App\Actions\Release;

use App\Models\Release;
use App\Repositories\ReleaseRepository;
use App\Services\AuthService;
use App\Services\Cache\ReleaseCacheService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class FollowReleaseAction
{
    public function __construct(
        private ReleaseRepository $releases,
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(Release $release): void
    {
        try {
            DB::beginTransaction();

            if ($release->is_followed()->exists() === false) {
                $this->releases->follow(release: $release);
                AuthService::incrementFollowedReleasesCount();
                ReleaseCacheService::setIsFollowed(id: $release->id, value: true);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            if (config('app.debug')) {
                throw $e;
            }

            throw new Exception("Internal Server Error.");
        }
    }
}
