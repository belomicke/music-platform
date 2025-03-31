<?php

declare(strict_types=1);

namespace App\Queries\EmailVerificationCode;

use App\Models\EmailVerificationCode;

final class CreateEmailVerificationCodeQuery
{
    public function execute(string $email): EmailVerificationCode
    {
        $model = new EmailVerificationCode();

        $model->email = $email;
        $model->code = strval(rand(100000, 999999));

        $model->save();

        return $model->fresh();
    }
}
