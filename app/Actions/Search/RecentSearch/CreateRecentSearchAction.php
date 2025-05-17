<?php

declare(strict_types=1);

namespace App\Actions\Search\RecentSearch;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\RecentSearch;
use App\Repositories\ArtistRepository;
use App\Repositories\ReleaseRepository;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class CreateRecentSearchAction
{
    public function __construct(
        private ArtistRepository  $artists,
        private ReleaseRepository $releases
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(string $uuid, string $type): void
    {
        $user = AuthService::user();

        try {
            DB::beginTransaction();

            if ($user->recent_searches()->count() === 10) {
                $user->recent_searches()->oldest()->delete();
            }

            if ($type === "artist") {
                $artist = $this->artists->getByUUID(uuid: $uuid);

                if ($artist === null) {
                    throw new ArtistNotFoundException();
                }
            } else if ($type === "release") {
                $release = $this->releases->getByUUID(uuid: $uuid);

                if ($release === null) {
                    throw new ReleaseNotFoundException();
                }
            }

            $recentSearch = new RecentSearch();

            $recentSearch->user_id = $user->id;
            $recentSearch->uuid = $uuid;
            $recentSearch->type = $type;

            $recentSearch->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            if (config('app.debug')) {
                throw $e;
            }

            throw new Exception();
        }
    }
}
