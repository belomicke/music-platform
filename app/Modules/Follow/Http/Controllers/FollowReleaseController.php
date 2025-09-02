<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\FollowReleaseAction;
use App\Modules\Follow\Exceptions\ReleaseAlreadyFollowedException;
use Illuminate\Http\JsonResponse;

final class FollowReleaseController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     * @throws ReleaseAlreadyFollowedException
     */
    public function __invoke(
        IdRequest           $request,
        FollowReleaseAction $followReleaseAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $followReleaseAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
