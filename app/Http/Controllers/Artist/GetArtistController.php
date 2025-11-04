<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\GetArtistAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use Illuminate\Http\JsonResponse;

final class GetArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(
        string          $uuid,
        GetArtistAction $getArtistAction
    ): JsonResponse
    {
        $artist = $getArtistAction->execute(uuid: $uuid);

        return $this->success([
            "artist" => ArtistResource::make(resource: $artist),
        ]);
    }
}
