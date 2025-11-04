<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\ResetPasswordDTO;
use App\Exceptions\Auth\ExpiredPasswordResetTokenException;
use App\Models\User;
use App\Repositories\PasswordResetTokenRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

final readonly class ResetPasswordAction
{
    public function __construct(
        private PasswordResetTokenRepository $passwordResetTokens,
    ) {}

    /**
     * @throws ExpiredPasswordResetTokenException
     */
    public function execute(ResetPasswordDTO $data): string
    {
        $tokenExists = $this->passwordResetTokens->getByEmail(email: $data->email);

        if ($tokenExists === false) {
            throw new ExpiredPasswordResetTokenException();
        }

        return Password::reset([
            "token" => $data->token,
            "email" => $data->email,
            "password" => $data->password,
            "password_confirmation" => $data->password_confirmation,
        ], function (User $user, string $password) {
            $user->password = Hash::make($password);
            $user->save();

            event(new PasswordReset($user));
        });
    }
}
