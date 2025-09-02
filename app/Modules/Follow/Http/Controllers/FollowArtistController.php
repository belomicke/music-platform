<?php

declare(strict_types=1);

namespace App\Modules\Follow\Http\Controllers;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Modules\Follow\Actions\FollowArtistAction;
use App\Modules\Follow\Exceptions\ArtistAlreadyFollowedException;
use Illuminate\Http\JsonResponse;

final class FollowArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     * @throws ArtistAlreadyFollowedException
     */
    public function __invoke(
        IdRequest          $request,
        FollowArtistAction $followArtistAction
    ): JsonResponse
    {
        $uuid = $request->input("id");

        $followArtistAction->execute(
            uuid: $uuid,
        );

        return $this->success();
    }
}
