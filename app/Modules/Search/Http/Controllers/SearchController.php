<?php

declare(strict_types=1);

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Artist\Http\Resources\ArtistResource;
use App\Modules\Release\Http\Resources\ReleaseResource;
use App\Modules\Search\Actions\SearchAction;
use App\Modules\Track\Http\Resources\TrackResource;
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
