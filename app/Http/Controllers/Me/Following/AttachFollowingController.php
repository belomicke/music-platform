<?php

declare(strict_types=1);

namespace App\Http\Controllers\Me\Following;

use App\Actions\Me\Following\AttachFollowingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Me\MutateFollowingRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

final class AttachFollowingController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        MutateFollowingRequest $request,
        AttachFollowingAction  $attachFollowingAction
    ): JsonResponse
    {
        $uuid = $request->input('id');
        $type = $request->input('type');

        $attachFollowingAction->execute(
            uuid: $uuid,
            type: $type
        );

        return $this->success();
    }
}
