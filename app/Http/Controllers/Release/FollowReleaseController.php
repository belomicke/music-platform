<?php

declare(strict_types=1);

namespace App\Http\Controllers\Release;

use App\Actions\Release\FollowReleaseAction;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Release;
use Illuminate\Http\JsonResponse;

final class FollowReleaseController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        Release             $release,
        FollowReleaseAction $followReleaseAction
    ): JsonResponse
    {
        if ($release->exists === false) {
            throw new ReleaseNotFoundException();
        }

        $followReleaseAction->execute(
            release: $release,
        );

        return $this->success();
    }
}
