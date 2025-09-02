<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\SendEmailVerificationCodeAction;
use App\Modules\Auth\Http\Requests\SendEmailVerificationCodeRequest;
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
