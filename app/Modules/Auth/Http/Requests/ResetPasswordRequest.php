<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Modules\Auth\DTOs\ResetPasswordDTO;

final class ResetPasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "token" => ["required"],
            "email" => ["required", "email"],
            "password" => ["required", "min:8", "confirmed"],
        ];
    }

    public function toDTO(): ResetPasswordDTO
    {
        return ResetPasswordDTO::fromArray($this->validated());
    }
}
