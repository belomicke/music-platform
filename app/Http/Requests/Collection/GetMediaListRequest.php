<?php

declare(strict_types=1);

namespace App\Http\Requests\Collection;

use App\Http\Requests\BaseRequest;

final class GetMediaListRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "offset" => ["integer", "min:0"]
        ];
    }
}
