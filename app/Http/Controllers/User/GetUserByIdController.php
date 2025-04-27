<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class GetUserByIdController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(
        User $user
    ): JsonResponse
    {
        if ($user->exists === false) {
            throw new UserNotFoundException();
        }

        return $this->success([
            "user" => UserResource::make($user),
        ]);
    }
}
