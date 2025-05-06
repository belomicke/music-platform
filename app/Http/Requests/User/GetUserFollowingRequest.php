<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class GetUserFollowingRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "type" => [
                Rule::in(["all", "artists", "users"])
            ],
            "offset" => ["integer", "min:0"]
        ];
    }
}
