<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Release\ReleaseResource;
use App\Models\Artist;
use Illuminate\Http\Request;

final class GetArtistReleasesController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(Request $request, Artist $artist)
    {
        if ($artist->exists === false) {
            throw new ArtistNotFoundException();
        }

        $artist->load([
            "releases",
            "releases.artists",
            "releases.artists.is_followed"
        ]);
        
        return $this->success([
            "releases" => ReleaseResource::collection($artist->releases),
            "count" => $artist->releases()->count(),
        ]);
    }
}
