<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\Models\Artist;
use App\Repositories\ArtistRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class FollowArtistAction
{
    public function __construct(
        private ArtistRepository $artists,
        private UserRepository   $users
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(Artist $artist): void
    {
        try {
            DB::beginTransaction();

            if ($artist->is_followed()->exists() === false) {
                $this->artists->follow(artist: $artist);
                $this->users->incrementFollowedArtistsCount(user: AuthService::user());
                $this->artists->incrementFollowersCount(artist: $artist);
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
