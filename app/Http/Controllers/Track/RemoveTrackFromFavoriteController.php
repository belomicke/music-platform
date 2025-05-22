<?php

declare(strict_types=1);

namespace App\Http\Controllers\Track;

use App\Actions\Track\RemoveTrackFromFavoriteAction;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\JsonResponse;

final class RemoveTrackFromFavoriteController extends Controller
{
    /**
     * @throws TrackNotFoundException
     */
    public function __invoke(
        Track                         $track,
        RemoveTrackFromFavoriteAction $removeTrackFromFavoriteAction
    ): JsonResponse
    {
        if ($track->exists === false) {
            throw new TrackNotFoundException();
        }

        $removeTrackFromFavoriteAction->execute(track: $track);

        return $this->success();
    }
}
