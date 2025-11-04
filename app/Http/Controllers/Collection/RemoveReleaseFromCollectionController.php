<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\RemoveReleaseFromCollectionAction;
use App\Exceptions\Collection\ReleaseAlreadyUnfollowedException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class RemoveReleaseFromCollectionController extends Controller
{
    /**
     * @throws ReleaseAlreadyUnfollowedException
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        IdRequest                         $request,
        RemoveReleaseFromCollectionAction $removeReleaseFromCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $removeReleaseFromCollectionAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
