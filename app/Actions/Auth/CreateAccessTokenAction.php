<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\User\UserNotFoundException;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

final class CreateAccessTokenAction
{
    /**
     * @throws UserNotFoundException
     * @throws InvalidCredentialsException
     */
    public function execute(string $email, string $password): string
    {
        $user = UserService::getByEmail(email: $email);

        if (Hash::check($password, $user->password)) {
            return $user->createToken(name: "*")->plainTextToken;
        } else {
            throw new InvalidCredentialsException();
        }
    }
}
