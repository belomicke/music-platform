<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
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
     * @throws Throwable
     */
    public function execute(string $uuid): void
    {
        $artist = $this->artists->getByUUID(uuid: $uuid);

        if ($artist === null) {
            throw new ArtistNotFoundException();
        }

        try {
            DB::beginTransaction();

            if ($artist->is_followed()->exists() === false) {
                $this->users->followArtist(artist: $artist);
                $this->users->incrementFollowedArtistsCount(user: Auth::user());
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
