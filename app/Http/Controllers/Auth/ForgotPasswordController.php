<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SendResetPasswordMailAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

final class ForgotPasswordController extends Controller
{
    public function __invoke(
        ForgotPasswordRequest       $request,
        SendResetPasswordMailAction $sendResetPasswordMailAction
    ): JsonResponse
    {
        $email = $request->input("email");

        $status = $sendResetPasswordMailAction->execute(email: $email);

        if ($status !== Password::ResetLinkSent) {
            return $this->error();
        }

        return $this->success();
    }
}
