<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Repositories\ArtistRepository;

final readonly class GetPopularArtistsAction
{
    public function __construct(
        private ArtistRepository $artists,
    ) {}

    public function execute(): ArtistMediaListDTO
    {
        return $this->artists->getPopular();
    }
}
