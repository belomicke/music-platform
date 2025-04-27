<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\Auth\SignInAction;
use App\Actions\User\CreateUserAction;
use App\DTOs\Auth\SignInDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\CurrentUserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

final class CreateUserController extends Controller
{
    /**
     * @throws Exception|Throwable
     */
    public function __invoke(
        CreateUserRequest $request,
        CreateUserAction  $createUserAction,
        SignInAction      $signInAction,
    ): JsonResponse
    {
        $createUserDTO = $request->toDTO();

        $user = $createUserAction->execute(data: $createUserDTO);

        $signInDTO = new SignInDTO(
            email: $createUserDTO->email,
            password: $createUserDTO->password
        );

        $signInAction->execute(data: $signInDTO);

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
