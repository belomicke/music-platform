<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\CreateUserAction;
use App\Modules\Auth\Actions\SignInAction;
use App\Modules\Auth\DTOs\SignInDTO;
use App\Modules\Auth\Http\Requests\CreateUserRequest;
use App\Modules\Auth\Http\Resources\CurrentUserResource;
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
