<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SignInAction;
use App\DTO\Auth\SignInDTO;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Resources\User\CurrentUserResource;
use App\Queries\User\GetUserByEmailQuery;
use Illuminate\Http\JsonResponse;

final class SignInController extends Controller
{
    public function __construct(
        private readonly GetUserByEmailQuery $getUserByEmailQuery
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(
        SignInRequest $request,
        SignInAction  $signInAction
    ): JsonResponse
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $signInAction->execute(data: new SignInDTO(
            email: $email,
            password: $password
        ));

        $user = $this->getUserByEmailQuery->execute(email: $email);

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
