<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteReleasesAction;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collection\GetMediaListRequest;
use App\Http\Resources\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteReleasesController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        GetMediaListRequest       $request,
        GetFavoriteReleasesAction $getFavoriteReleasesAction
    ): JsonResponse
    {
        $after = $request->input("after", "");

        $result = $getFavoriteReleasesAction->execute(
            after: $after
        );

        return $this->success([
            "releases" => ReleaseResource::collection($result->releases),
            "count" => $result->count
        ]);
    }
}
