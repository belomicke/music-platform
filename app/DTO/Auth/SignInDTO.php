<?php

declare(strict_types=1);

namespace App\DTO\Auth;

final class SignInDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
