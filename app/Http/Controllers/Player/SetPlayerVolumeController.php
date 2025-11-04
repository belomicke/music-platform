<?php

declare(strict_types=1);

namespace App\Http\Controllers\Player;

use App\Actions\Player\SetPlayerVolumeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\SetPlayerVolumeRequest;
use Illuminate\Http\JsonResponse;

final class SetPlayerVolumeController extends Controller
{

    public function __invoke(
        SetPlayerVolumeRequest $request,
        SetPlayerVolumeAction  $setPlayerVolumeAction
    ): JsonResponse
    {
        $volume_percent = $request->input("volume_percent");

        $setPlayerVolumeAction->execute(volume: $volume_percent);

        return $this->success();
    }
}
