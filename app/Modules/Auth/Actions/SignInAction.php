<?php

declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\DTOs\SignInDTO;
use App\Modules\Auth\Exceptions\InvalidCredentialsException;
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
