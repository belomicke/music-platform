<?php

declare(strict_types=1);

namespace App\Http\Controllers\Track;

use App\Http\Controllers\Controller;
use App\Http\Resources\Track\TrackResource;
use App\Models\Track;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetTracksController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $ids = $request->get("track_ids");

        if (count($ids) > 12) {
            return $this->error("Limit");
        }

        $relations = [
            "artists",
            "releases",
            "releases.artists"
        ];

        if (AuthService::check()) {
            $relations[] = "artists.is_followed";
            $relations[] = "releases.is_followed";
            $relations[] = "releases.artists.is_followed";
        }

        $tracks = Track::query()
            ->with(relations: $relations)
            ->whereIn("uuid", $ids)
            ->get();

        return $this->success([
            "tracks" => TrackResource::collection($tracks),
        ]);
    }
}
