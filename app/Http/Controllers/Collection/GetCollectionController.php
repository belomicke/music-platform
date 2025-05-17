<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetCollectionAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\CompactArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetCollectionController extends Controller
{
    public function __invoke(GetCollectionAction $getCollectionAction): JsonResponse
    {
        $collection = $getCollectionAction->execute();

        return $this->success([
            "artists" => [
                "items" => CompactArtistResource::collection($collection->artists->artists),
                "count" => $collection->artists->count
            ],
            "releases" => [
                "items" => ReleaseResource::collection($collection->releases->releases),
                "count" => $collection->releases->count
            ]
        ]);
    }
}
