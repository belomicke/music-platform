<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteTracksAction;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collection\GetMediaListRequest;
use App\Http\Resources\TrackResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteTracksController extends Controller
{
    /**
     * @throws TrackNotFoundException
     */
    public function __invoke(
        GetMediaListRequest     $request,
        GetFavoriteTracksAction $getFavoriteTracksAction
    ): JsonResponse
    {
        $after = $request->input("after", "");

        $result = $getFavoriteTracksAction->execute(
            after: $after
        );

        return $this->success([
            "tracks" => TrackResource::collection($result->tracks),
            "count" => $result->count
        ]);
    }
}
