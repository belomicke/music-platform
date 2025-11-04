<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Actions\Search\SearchAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ReleaseResource;
use App\Http\Resources\TrackResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SearchController extends Controller
{
    public function __invoke(
        Request      $request,
        SearchAction $searchAction
    ): JsonResponse
    {
        $query = $request->input("query");

        $result = $searchAction->execute(query: $query);

        return $this->success([
            "artists" => ArtistResource::collection($result->artists),
            "releases" => ReleaseResource::collection($result->releases),
            "tracks" => TrackResource::collection($result->tracks),
        ]);
    }
}
