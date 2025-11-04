<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\RemoveArtistFromCollectionAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Collection\ArtistAlreadyUnfollowedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class RemoveArtistFromCollectionController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyUnfollowedException
     */
    public function __invoke(
        IdRequest                        $request,
        RemoveArtistFromCollectionAction $removeArtistFromCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $removeArtistFromCollectionAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
