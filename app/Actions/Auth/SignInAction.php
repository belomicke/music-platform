<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTO\Auth\SignInDTO;
use App\Exceptions\Auth\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

final class SignInAction
{
    /**
     * @throws InvalidCredentialsException
     */
    public function execute(SignInDTO $data): void
    {
        $success = Auth::attempt([
            "email" => $data->email,
            "password" => $data->password
        ], true);

        if ($success === false) {
            throw new InvalidCredentialsException();
        }
    }
}
