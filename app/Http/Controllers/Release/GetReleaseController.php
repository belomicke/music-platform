<?php

declare(strict_types=1);

namespace App\Http\Controllers\Release;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Release\ReleaseResource;
use App\Models\Release;

final class GetReleaseController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(Release $release)
    {
        if ($release->exists === false) {
            throw new ReleaseNotFoundException();
        }

        $release->load(relations: [
            "is_followed",
            "artists",
            "artists.is_followed",
            "tracks"
        ]);

        return $this->success([
            "release" => ReleaseResource::make($release),
        ]);
    }
}
