<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\RemoveTrackFromCollectionAction;
use App\Exceptions\Collection\TrackAlreadyNotInFavoriteListException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class RemoveTrackFromCollectionController extends Controller
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyNotInFavoriteListException
     */
    public function __invoke(
        IdRequest                       $request,
        RemoveTrackFromCollectionAction $removeTrackFromCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $removeTrackFromCollectionAction->execute(
            uuid: $uuid
        );

        return $this->success();
    }
}
