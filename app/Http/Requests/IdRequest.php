<?php

declare(strict_types=1);

namespace App\Http\Requests;

final class IdRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "id" => ["required", "string", "uuid:4"]
        ];
    }
}
