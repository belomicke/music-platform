<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\RemoveTrackFromFavoriteAction;
use App\Modules\Follow\Exceptions\TrackAlreadyNotInFavoriteListException;
use Illuminate\Http\JsonResponse;

final class RemoveTrackFromFavoriteController extends Controller
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyNotInFavoriteListException
     */
    public function __invoke(
        IdRequest                     $request,
        RemoveTrackFromFavoriteAction $removeTrackFromFavoriteAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $removeTrackFromFavoriteAction->execute(
            uuid: $uuid
        );

        return $this->success();
    }
}
