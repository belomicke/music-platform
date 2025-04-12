<?php

declare(strict_types=1);

namespace App\DTOs\User;

final class CreateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $verification_code
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data["name"],
            email: $data["email"],
            password: $data["password"],
            verification_code: $data["verification_code"],
        );
    }
}
