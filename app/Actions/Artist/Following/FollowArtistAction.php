<?php

declare(strict_types=1);

namespace App\Actions\Artist\Following;

use App\Models\Artist;
use App\Repositories\ArtistRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class FollowArtistAction
{
    public function __construct(
        private ArtistRepository $artists,
        private UserRepository   $users
    ) {}

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function execute(Artist $artist): void
    {
        try {
            DB::beginTransaction();

            if ($artist->is_followed()->exists() === false) {
                $this->artists->follow(id: $artist->id);
                $this->artists->incrementFollowersCount(artist: $artist);
                $this->users->incrementFollowedArtistsCount(user: Auth::user());
            }

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
