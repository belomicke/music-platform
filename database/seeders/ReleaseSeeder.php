<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Release;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ReleaseSeeder extends Seeder
{
    public function run(): void
    {
        $artists = Artist::all();

        $data = [];

        foreach ($artists as $artist) {
            $releases = Release::factory($artist->release_count)->create();

            foreach ($releases as $release) {
                $data[] = [
                    "artist_id" => $artist->id,
                    "release_id" => $release->id,
                    "updated_at" => now(),
                    "created_at" => now(),
                ];
            }

            if (count($data) === 5000) {
                DB::table('artist_release')->insert($data);
                $data = [];
            }
        }

        DB::table('artist_release')->insert($data);
    }
}
