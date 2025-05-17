<?php

declare(strict_types=1);

namespace App\Http\Requests\Search;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateRecentSearchRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => ["required", "uuid"],
            "type" => ["required", "string", Rule::in(["artist", "release"])]
        ];
    }
}
