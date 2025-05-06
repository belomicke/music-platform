<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ArtistFollowingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->pluck('id')->toArray();
        $artists = Artist::query()->pluck('id')->toArray();
        $data = [];

        foreach ($users as $user) {
            foreach ($artists as $artist) {
                $data[] = [
                    "artist_id" => $artist,
                    "user_id" => $user
                ];

                if (count($data) === 5000) {
                    DB::table('artist_user')->insert($data);
                    $data = [];
                }
            }
        }

        DB::table('artist_user')->insert($data);
    }
}
