<?php

declare(strict_types=1);

namespace App\Modules\Collection\Http\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Collection\Actions\GetFavoriteReleasesAction;
use App\Modules\Collection\Http\Requests\GetMediaListRequest;
use App\Modules\Release\Http\Resources\ReleaseResource;
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
