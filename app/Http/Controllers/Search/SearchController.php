<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Actions\SearchAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\CompactArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use App\Http\Resources\Track\TrackResource;
use Illuminate\Http\Request;

final class SearchController extends Controller
{
    public function __invoke(Request $request, SearchAction $searchAction)
    {
        $query = $request->input("query");
        $type = $request->input("type", "all");

        $result = $searchAction->execute(
            query: $query,
            type: $type
        );

        return $this->success([
            "artists" => CompactArtistResource::collection($result["artists"]),
            "releases" => ReleaseResource::collection($result["releases"]),
            "tracks" => TrackResource::collection($result["tracks"]),
        ]);
    }
}
