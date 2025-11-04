<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTOs\Auth\SignInDTO;
use App\Http\Requests\BaseRequest;

final class SignInRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required"]
        ];
    }

    public function toDTO(): SignInDTO
    {
        return SignInDTO::fromArray($this->validated());
    }
}
