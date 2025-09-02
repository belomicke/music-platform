<?php

declare(strict_types=1);

namespace App\Modules\Artist\Http\Controllers;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Modules\Artist\Actions\GetArtistAction;
use App\Modules\Artist\Http\Resources\ArtistResource;
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
