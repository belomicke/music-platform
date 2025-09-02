<?php

declare(strict_types=1);

namespace App\Modules\Player\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Player\Repositories\PlayerRepository;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class GetTrackFileController extends Controller
{
    public function __construct(
        private readonly PlayerRepository $player,
    ) {}

    public function __invoke(): BinaryFileResponse
    {
        $trackId = $this->player->getTrackId();

        $path = Storage::disk("public")->path("tracks/$trackId.mp3");

        $response = new BinaryFileResponse($path);

        BinaryFileResponse::trustXSendfileTypeHeader();

        return $response;
    }
}
