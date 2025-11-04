<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\AddArtistToCollectionAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Collection\ArtistAlreadyFollowedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class AddArtistToCollectionController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyFollowedException
     */
    public function __invoke(
        IdRequest                   $request,
        AddArtistToCollectionAction $addArtistToCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $addArtistToCollectionAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
