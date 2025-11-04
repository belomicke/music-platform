<?php

namespace App\Http\Controllers\Player;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SetNextTrackController extends Controller
{
    public function __construct(
        private readonly PlayerService $playerService
    ) {}

    /**
     * @throws ReleaseNotFoundException
     * @throws TrackNotFoundException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $state = $this->playerService->setNextTrack();

        return $this->success(data: $state->toArray());
    }
}
