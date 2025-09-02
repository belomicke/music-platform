<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\AddTrackToFavoriteAction;
use App\Modules\Follow\Exceptions\TrackAlreadyInFavoriteListException;
use Illuminate\Http\JsonResponse;

final class AddTrackToFavoriteController extends Controller
{
    /**
     * @throws TrackNotFoundException
     * @throws TrackAlreadyInFavoriteListException
     */
    public function __invoke(
        IdRequest                $request,
        AddTrackToFavoriteAction $addTrackToFavoriteAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $addTrackToFavoriteAction->execute(
            uuid: $uuid
        );

        return $this->success();
    }
}
