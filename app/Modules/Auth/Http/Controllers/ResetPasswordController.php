<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\ResetPasswordAction;
use App\Modules\Auth\Exceptions\ExpiredPasswordResetTokenException;
use App\Modules\Auth\Http\Requests\ResetPasswordRequest;
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
