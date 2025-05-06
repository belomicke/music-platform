<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\GetUserFollowersAction;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserFollowersRequest;
use App\Http\Resources\User\CompactUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class GetUserFollowersController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(
        GetUserFollowersRequest $request,
        User                    $user,
        GetUserFollowersAction  $getUserFollowersAction
    ): JsonResponse
    {
        if ($user->exists === false) {
            throw new UserNotFoundException();
        }

        $offset = (int)$request->input("offset", 0);

        $result = $getUserFollowersAction->execute(
            user: $user,
            offset: $offset
        );

        return $this->success([
            "users" => CompactUserResource::collection($result->users),
            "count" => $result->count
        ]);
    }
}
