<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SendEmailVerificationCodeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendEmailVerificationCodeRequest;
use Illuminate\Http\JsonResponse;


final class SendEmailVerificationCodeController extends Controller
{
    public function __invoke(
        SendEmailVerificationCodeRequest $request,
        SendEmailVerificationCodeAction  $sendEmailVerificationCodeAction
    ): JsonResponse
    {
        $email = $request->input("email");

        $sendEmailVerificationCodeAction->execute(email: $email);

        return $this->success();
    }
}
