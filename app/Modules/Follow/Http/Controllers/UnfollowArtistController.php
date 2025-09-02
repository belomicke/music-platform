<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\UnfollowArtistAction;
use App\Modules\Follow\Exceptions\ArtistAlreadyUnfollowedException;
use Illuminate\Http\JsonResponse;

final class UnfollowArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyUnfollowedException
     */
    public function __invoke(
        IdRequest            $request,
        UnfollowArtistAction $unfollowArtistAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $unfollowArtistAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
