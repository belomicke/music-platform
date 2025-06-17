<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Actions\Search\RecentSearch\GetRecentSearchesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetRecentSearchesController extends Controller
{
    public function __invoke(GetRecentSearchesAction $getRecentSearchesAction): JsonResponse
    {
        $data = $getRecentSearchesAction->execute();
        $json = [];

        foreach ($data as $item) {
            if ($item->type === "artist") {
                $json[] = [
                    "data" => ArtistResource::make($item->data),
                    "type" => $item->type
                ];
            } else if ($item->type === "release") {
                $json[] = [
                    "data" => ReleaseResource::make($item->data),
                    "type" => $item->type
                ];
            }
        }

        return $this->success([
            "recent_searches" => $json
        ]);
    }
}
