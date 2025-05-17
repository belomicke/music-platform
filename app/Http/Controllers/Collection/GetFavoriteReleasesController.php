<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteReleasesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collection\GetMediaListRequest;
use App\Http\Resources\Release\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteReleasesController extends Controller
{
    public function __invoke(
        GetMediaListRequest       $request,
        GetFavoriteReleasesAction $getFavoriteReleasesAction
    ): JsonResponse
    {
        $offset = (int)$request->input("offset", 0);

        $result = $getFavoriteReleasesAction->execute(
            offset: $offset
        );

        return $this->success([
            "releases" => ReleaseResource::collection($result->releases),
            "count" => $result->count
        ]);
    }
}
