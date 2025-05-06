<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\GetUserFollowedArtistsAction;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\CompactArtistResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetUserFollowedArtistsController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(
        Request                      $request,
        User                         $user,
        GetUserFollowedArtistsAction $getUserFollowedArtistsAction
    ): JsonResponse
    {
        $offset = (int)$request->input('offset');

        if ($user->exists === false) {
            throw new UserNotFoundException();
        }

        $data = $getUserFollowedArtistsAction->execute(
            user: $user,
            offset: $offset
        );

        return $this->success([
            "artists" => CompactArtistResource::collection($data->artists),
            "count" => $data->count,
        ]);
    }
}
