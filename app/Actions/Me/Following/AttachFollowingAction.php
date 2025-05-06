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

final readonly class AttachFollowingAction
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
            $this->attachUser(uuid: $uuid);
        } else if ($type === "artist") {
            $this->attachArtist(uuid: $uuid);
        }
    }

    /**
     * @throws Throwable
     */
    private function attachArtist(string $uuid): void
    {
        $artist = $this->artists->getByUUID(uuid: $uuid);

        if ($artist === null) {
            throw new UserNotFoundException();
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

    /**
     * @throws Throwable
     */
    private function attachUser(string $uuid): void
    {
        $user = $this->users->getByUUID(uuid: $uuid);

        if ($user === null) {
            throw new ArtistNotFoundException();
        }

        try {
            DB::beginTransaction();

            if ($user->is_followed()->exists() === false) {
                $this->users->followUser(user: $user);
                $this->users->incrementFollowedUsersCount(user: Auth::user());
                $this->users->incrementFollowersCount(user: $user);
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
