<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

final class GetUserFollowersRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "offset" => ["required", "integer", "min:0"]
        ];
    }
}
