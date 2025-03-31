<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\GetUserByIdAction;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;

final class GetUserByIdController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(
        string            $id,
        GetUserByIdAction $getUserByIdAction
    ): JsonResponse
    {
        $user = $getUserByIdAction->execute(id: $id);

        return $this->success([
            "user" => UserResource::make($user),
        ]);
    }
}
