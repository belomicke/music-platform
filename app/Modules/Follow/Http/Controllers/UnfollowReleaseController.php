<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\UnfollowReleaseAction;
use App\Modules\Follow\Exceptions\ReleaseAlreadyUnfollowedException;
use Illuminate\Http\JsonResponse;

final class UnfollowReleaseController extends Controller
{
    /**
     * @throws ReleaseAlreadyUnfollowedException
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        IdRequest             $request,
        UnfollowReleaseAction $unfollowReleaseAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $unfollowReleaseAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
