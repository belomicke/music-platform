<?php

declare(strict_types=1);

namespace App\Http\Controllers\Player;

use App\Actions\Player\GetPlayerStateAction;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class GetPlayerStateController extends Controller
{
    /**
     * @throws TrackNotFoundException
     */
    public function __invoke(
        GetPlayerStateAction $getPlayerStateAction
    ): JsonResponse
    {
        $result = $getPlayerStateAction->execute();

        return $this->success($result->toArray());
    }
}
