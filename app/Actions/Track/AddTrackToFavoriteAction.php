<?php

declare(strict_types=1);

namespace App\Actions\Track;

use App\Models\Track;
use App\Repositories\TrackRepository;
use App\Services\AuthService;
use App\Services\Cache\TrackCacheService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class AddTrackToFavoriteAction
{
    public function __construct(
        private TrackRepository $tracks
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(Track $track): void
    {
        try {
            DB::beginTransaction();

            $this->tracks->addToFavorite(track: $track);
            AuthService::incrementFavoriteTracksCount();
            TrackCacheService::setIsFavorite(id: $track->id, value: true);
            TrackCacheService::clearFavoriteTracks();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            if (config('app.debug')) {
                throw $e;
            }

            throw new Exception("Internal Server Error.");
        }
    }
}
