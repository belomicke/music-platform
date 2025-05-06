<?php

declare(strict_types=1);

namespace App\Http\Requests\Me;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class MutateFollowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => ["required", "string"],
            "type" => [
                Rule::in(["all", "artist", "user"])
            ],
        ];
    }
}
