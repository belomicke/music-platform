<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\AddReleaseToCollectionAction;
use App\Exceptions\Collection\ReleaseAlreadyFollowedException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use Illuminate\Http\JsonResponse;

final class AddReleaseToCollectionController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     * @throws ReleaseAlreadyFollowedException
     */
    public function __invoke(
        IdRequest                    $request,
        AddReleaseToCollectionAction $addReleaseToCollectionAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $addReleaseToCollectionAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
