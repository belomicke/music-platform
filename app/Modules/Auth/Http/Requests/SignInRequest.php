<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Modules\Auth\DTOs\SignInDTO;

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
