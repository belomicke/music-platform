<?php

declare(strict_types=1);

namespace App\DTO\Auth;

final class ResetPasswordDTO
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
    ) {}
}
