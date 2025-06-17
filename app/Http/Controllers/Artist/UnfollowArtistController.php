<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\UnfollowArtistAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Throwable;

final class UnfollowArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws Throwable
     */
    public function __invoke(
        Artist               $artist,
        UnfollowArtistAction $unfollowArtistAction
    ): JsonResponse
    {
        if ($artist->exists === false) {
            throw new ArtistNotFoundException();
        }

        $unfollowArtistAction->execute(
            artist: $artist,
        );

        return $this->success();
    }
}
