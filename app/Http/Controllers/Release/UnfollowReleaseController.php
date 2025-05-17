<?php

declare(strict_types=1);

namespace App\Http\Controllers\Release;

use App\Actions\Release\UnfollowReleaseAction;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Release;
use Illuminate\Http\JsonResponse;

final class UnfollowReleaseController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        Release               $release,
        UnfollowReleaseAction $unfollowReleaseAction
    ): JsonResponse
    {
        if ($release->exists === false) {
            throw new ReleaseNotFoundException();
        }

        $unfollowReleaseAction->execute(
            release: $release,
        );

        return $this->success();
    }
}
