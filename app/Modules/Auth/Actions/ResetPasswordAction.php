<?php

declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Models\User;
use App\Modules\Auth\DTOs\ResetPasswordDTO;
use App\Modules\Auth\Exceptions\ExpiredPasswordResetTokenException;
use App\Modules\Auth\Repositories\PasswordResetTokenRepository;
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
