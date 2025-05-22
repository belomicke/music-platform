<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteTracksAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collection\GetMediaListRequest;
use App\Http\Resources\Track\TrackResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteTracksController extends Controller
{
    public function __invoke(
        GetMediaListRequest     $request,
        GetFavoriteTracksAction $getFavoriteTracksAction
    ): JsonResponse
    {
        $offset = (int)$request->input("offset", 0);

        $result = $getFavoriteTracksAction->execute(
            offset: $offset
        );

        return $this->success([
            "tracks" => TrackResource::collection($result->tracks),
            "count" => $result->count
        ]);
    }
}
