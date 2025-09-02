<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Modules\Auth\DTOs\CreateUserDTO;

final class CreateUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "min:4", "max:32"],
            "email" => ["required", "unique:users", "email"],
            "password" => ["required", "confirmed"],
            "verification_code" => ["required", "string", "min:6", "max:6"],
        ];
    }

    public function toDTO(): CreateUserDTO
    {
        return CreateUserDTO::fromArray($this->validated());
    }
}
