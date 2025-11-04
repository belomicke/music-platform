<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResetPasswordAction;
use App\Exceptions\Auth\ExpiredPasswordResetTokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

final class ResetPasswordController extends Controller
{
    /**
     * @throws ExpiredPasswordResetTokenException
     */
    public function __invoke(
        ResetPasswordRequest $request,
        ResetPasswordAction  $resetPasswordAction
    ): JsonResponse
    {
        $data = $request->toDTO();

        $status = $resetPasswordAction->execute(data: $data);

        if ($status !== Password::PasswordReset) {
            return $this->error();
        }

        return $this->success();
    }
}
