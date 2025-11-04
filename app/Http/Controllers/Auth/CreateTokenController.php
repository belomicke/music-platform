<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateAccessTokenAction;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use Illuminate\Http\JsonResponse;

final class CreateTokenController extends Controller
{
    /**
     * @throws UserNotFoundException
     * @throws InvalidCredentialsException
     */
    public function __invoke(
        SignInRequest           $request,
        CreateAccessTokenAction $createAccessTokenAction
    ): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $token = $createAccessTokenAction->execute(
            email: $email,
            password: $password
        );

        return $this->success([
            "token" => $token
        ]);
    }
}
