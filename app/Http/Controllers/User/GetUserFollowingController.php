<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\GetUserFollowingAction;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserFollowingRequest;
use App\Http\Resources\Artist\CompactArtistResource;
use App\Http\Resources\User\CompactUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class GetUserFollowingController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(
        GetUserFollowingRequest $request,
        User                    $user,
        GetUserFollowingAction  $getUserFollowingAction
    ): JsonResponse
    {
        if ($user->exists === false) {
            throw new UserNotFoundException();
        }

        $type = $request->input("type");
        $offset = (int)$request->input("offset", 0);

        $result = $getUserFollowingAction->execute(
            user: $user,
            type: $type,
            offset: $offset
        );

        $json = [
            "count" => $result->count
        ];

        if ($type === "artists") {
            $json["artists"] = CompactArtistResource::collection($result->artists);
        } else if ($type === "users") {
            $json["users"] = CompactUserResource::collection($result->users);
        }

        return $this->success($json);
    }
}
