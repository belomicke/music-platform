<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\EmailVerificationCode;

final class EmailVerificationCodeRepository
{
    public function create(string $email): EmailVerificationCode
    {
        $model = new EmailVerificationCode();

        $model->email = $email;
        $model->code = strval(rand(100000, 999999));

        $model->save();

        return $model->fresh();
    }

    public function getByEmail(string $email): EmailVerificationCode|null
    {
        return EmailVerificationCode::query()
            ->where("email", $email)
            ->first();
    }

    public function delete(string $email): void
    {
        EmailVerificationCode::query()
            ->where("email", $email)
            ->delete();
    }
}
