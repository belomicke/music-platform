<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Support\Facades\DB;

final class ArtistFollowingSeeder
{
    public function run(): void
    {
        $artists = Artist::query()->pluck('id')->toArray();
        $data = [];

        foreach ($artists as $artist) {
            $data[] = [
                "artist_id" => $artist,
                "user_id" => 1
            ];
        }

        DB::table('artist_user')->insert($data);
    }
}
