<?php

declare(strict_types=1);

namespace App\Modules\Collection\Http\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Collection\Actions\GetFavoriteTracksAction;
use App\Modules\Collection\Http\Requests\GetMediaListRequest;
use App\Modules\Track\Http\Resources\TrackResource;
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
