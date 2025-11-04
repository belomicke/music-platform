<?php

declare(strict_types=1);

namespace App\Http\Controllers\Player;

use App\Actions\Player\SetRepeatStateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\SetRepeatStateRequest;
use Illuminate\Http\JsonResponse;

final class SetRepeatStateController extends Controller
{
    public function __invoke(
        SetRepeatStateRequest $request,
        SetRepeatStateAction  $setRepeatStateAction
    ): JsonResponse
    {
        $state = $request->input("state");

        $setRepeatStateAction->execute(state: $state);

        return $this->success();
    }
}
