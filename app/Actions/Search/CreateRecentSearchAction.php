<?php

declare(strict_types=1);

namespace App\Actions\Search;

use App\Models\RecentSearch;
use App\Services\ArtistService;
use App\Services\AuthService;
use App\Services\ReleaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class CreateRecentSearchAction
{
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
                ArtistService::exists(uuid: $uuid);
            } else if ($type === "release") {
                ReleaseService::exists(uuid: $uuid);
            }

            $recentSearch = new RecentSearch();

            $recentSearch->user_id = $user->id;
            $recentSearch->uuid = $uuid;
            $recentSearch->type = $type;

            $recentSearch->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            if (config("app.debug")) {
                throw $e;
            }

            throw new Exception();
        }
    }
}
