<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\StreamInterface;

final class FakerHelpers
{
    /**
     * @throws ConnectionException
     */
    public static function generateImage(string $letter): StreamInterface
    {
        $backgroundColor = substr(md5((string)rand()), 0, 6);
        $textColor = substr(md5((string)rand()), 0, 6);

        $response = Http::get("https://dummyimage.com/640/$backgroundColor/$textColor.png?text=$letter");

        return $response->getBody();
    }

    public function generateColor(): string
    {
        return substr(md5((string)rand()), 0, 6);
    }
}
