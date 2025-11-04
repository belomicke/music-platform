<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetCollectionAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ReleaseResource;
use App\Http\Resources\TrackResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

final class GetCollectionController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws ReleaseNotFoundException
     * @throws TrackNotFoundException
     */
    public function __invoke(GetCollectionAction $getCollectionAction): JsonResponse
    {
        $user = AuthService::user();
        $collection = $getCollectionAction->execute();

        return $this->success([
            "tracks" => [
                "items" => TrackResource::collection($collection->tracks),
                "count" => $user->favorite_tracks_count
            ],
            "artists" => [
                "items" => ArtistResource::collection($collection->artists),
                "count" => $user->favorite_artists_count
            ],
            "releases" => [
                "items" => ReleaseResource::collection($collection->releases),
                "count" => $user->favorite_releases_count
            ],
        ]);
    }
}
