<?php

declare(strict_types=1);

namespace App\Actions\Release;

use App\Models\Release;
use App\Repositories\ReleaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class UnfollowReleaseAction
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

            if ($release->is_followed()->exists()) {
                $this->releases->unfollow(release: $release);
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
