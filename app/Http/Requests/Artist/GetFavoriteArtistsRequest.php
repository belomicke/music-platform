<?php

declare(strict_types=1);

namespace App\Http\Requests\Artist;

use App\Http\Requests\BaseRequest;

final class GetFavoriteArtistsRequest extends BaseRequest
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
