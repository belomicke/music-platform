<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

final class ResetPasswordDTO
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
        public string $password_confirmation,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            token: $data['token'],
            email: $data['email'],
            password: $data['password'],
            password_confirmation: $data['password_confirmation'],
        );
    }
}
