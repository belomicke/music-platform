<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\AddTrackToCollectionAction;
use App\Exceptions\Collection\TrackAlreadyInFavoriteListException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class AddTrackToCollectionController extends Controller
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyInFavoriteListException
     */
    public function __invoke(
        IdRequest                  $request,
        AddTrackToCollectionAction $addTrackToCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $addTrackToCollectionAction->execute(
            uuid: $uuid
        );

        return $this->success();
    }
}
