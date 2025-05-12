<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\FollowArtistAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Throwable;

final class FollowArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws Throwable
     */
    public function __invoke(
        Artist             $artist,
        FollowArtistAction $followArtistAction
    ): JsonResponse
    {
        if ($artist->exists === false) {
            throw new ArtistNotFoundException();
        }

        $followArtistAction->execute(
            uuid: $artist->uuid,
        );

        return $this->success();
    }
}
