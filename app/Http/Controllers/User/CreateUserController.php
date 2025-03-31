<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\Auth\SignInAction;
use App\Actions\User\CreateUserAction;
use App\DTO\Auth\SignInDTO;
use App\DTO\User\CreateUserDTO;
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
        $name = $request->input("name");
        $email = $request->input("email");
        $password = $request->input("password");
        $code = $request->input("verification_code");

        $user = $createUserAction->execute(
            data: new CreateUserDTO(
                name: $name,
                email: $email,
                password: $password,
                verificationCode: $code
            )
        );

        $signInAction->execute(data: new SignInDTO(
            email: $email,
            password: $password,
        ));

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
