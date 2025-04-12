<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\GetArtistByUuidAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\ArtistResource;
use Illuminate\Http\JsonResponse;

final class GetArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(
        string                $uuid,
        GetArtistByUuidAction $getArtistByUuidAction
    ): JsonResponse
    {
        $artist = $getArtistByUuidAction->execute(uuid: $uuid);

        return $this->success([
            "artist" => ArtistResource::make($artist)
        ]);
    }
}
