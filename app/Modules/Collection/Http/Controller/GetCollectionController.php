<?php

declare(strict_types=1);

namespace App\Modules\Collection\Http\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Artist\Http\Resources\ArtistResource;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Collection\Actions\GetCollectionAction;
use App\Modules\Release\Http\Resources\ReleaseResource;
use App\Modules\Track\Http\Resources\TrackResource;
use Illuminate\Http\JsonResponse;

final class GetCollectionController extends Controller
{
    public function __invoke(GetCollectionAction $getCollectionAction): JsonResponse
    {
        $user = AuthService::user();
        $collection = $getCollectionAction->execute();

        return $this->success([
            "artists" => [
                "items" => ArtistResource::collection($collection->artists),
                "count" => $user->followed_artists_count
            ],
            "releases" => [
                "items" => ReleaseResource::collection($collection->releases),
                "count" => $user->followed_releases_count
            ],
            "tracks" => [
                "items" => TrackResource::collection($collection->tracks),
                "count" => $user->favorite_tracks_count
            ],
        ]);
    }
}
