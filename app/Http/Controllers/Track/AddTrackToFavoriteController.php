<?php

declare(strict_types=1);

namespace App\Http\Controllers\Track;

use App\Actions\Track\AddTrackToFavoriteAction;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\JsonResponse;
use Throwable;

final class AddTrackToFavoriteController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        Track                    $track,
        AddTrackToFavoriteAction $addTrackToFavoriteAction
    ): JsonResponse
    {
        if ($track->exists === false) {
            throw new TrackNotFoundException();
        }

        $addTrackToFavoriteAction->execute(track: $track);

        return $this->success();
    }
}
