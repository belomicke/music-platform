<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = Artist::all();

        $data = [];

        foreach ($artists as $artist) {
            $releases = $artist->releases;

            foreach ($releases as $release) {
                $tracks = $release->tracks;

                foreach ($tracks as $track) {
                    $data[] = [
                        "artist_id" => $artist->id,
                        "track_id" => $track->id,
                        "updated_at" => now(),
                        "created_at" => now(),
                    ];

                    if (rand(1, 10) === 10) {
                        $secondArtist = Artist::query()
                            ->whereNot("id", $artist->id)
                            ->inRandomOrder()
                            ->first();

                        $data[] = [
                            "artist_id" => $secondArtist->id,
                            "track_id" => $track->id,
                            "updated_at" => now(),
                            "created_at" => now(),
                        ];
                    }

                    if (count($data) === 5000) {
                        DB::table("artist_track")->insert($data);
                        $data = [];
                    }
                }
            }
        }

        DB::table("artist_track")->insert($data);
    }
}
