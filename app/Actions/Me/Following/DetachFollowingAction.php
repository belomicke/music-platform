<?php

declare(strict_types=1);

namespace App\Actions\Me\Following;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\ArtistRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class DetachFollowingAction
{
    public function __construct(
        private ArtistRepository $artists,
        private UserRepository   $users
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(string $uuid, string $type): void
    {
        if ($type === "user") {
            $this->detachUser(uuid: $uuid);
        } else if ($type === "artist") {
            $this->detachArtist(uuid: $uuid);
        }
    }

    /**
     * @throws Throwable
     */
    private function detachArtist(string $uuid): void
    {
        $artist = $this->artists->getByUUID(uuid: $uuid);

        if ($artist === null) {
            throw new ArtistNotFoundException();
        }

        try {
            DB::beginTransaction();

            if ($artist->is_followed()->exists()) {
                $this->users->unfollowArtist(artist: $artist);
                $this->users->decrementFollowedArtistsCount(user: Auth::user());
                $this->artists->decrementFollowersCount(artist: $artist);
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

    /**
     * @throws Throwable
     */
    private function detachUser(string $uuid): void
    {
        $user = $this->users->getByUUID(uuid: $uuid);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        try {
            DB::beginTransaction();

            if ($user->is_followed()->exists()) {
                $this->users->unfollowUser(user: $user);
                $this->users->decrementFollowedUsersCount(user: Auth::user());
                $this->users->decrementFollowersCount(user: $user);
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
