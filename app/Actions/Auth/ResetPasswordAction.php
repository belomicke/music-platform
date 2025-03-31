<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTO\Auth\ResetPasswordDTO;
use App\Exceptions\Auth\ExpiredPasswordResetTokenException;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

final class ResetPasswordAction
{
    /**
     * @throws ExpiredPasswordResetTokenException
     */
    public function execute(ResetPasswordDTO $data): string
    {
        $tokenExists = DB::table("password_reset_tokens")
            ->where("email", $data->email)
            ->exists();

        if (!$tokenExists) {
            throw new ExpiredPasswordResetTokenException();
        }

        return Password::reset([
            "token" => $data->token,
            "email" => $data->email,
            "password" => $data->password,
            "password_confirmation" => $data->passwordConfirmation,
        ], function (User $user, string $password) {
            $user->password = Hash::make($password);
            $user->save();

            event(new PasswordReset($user));
        });
    }
}
