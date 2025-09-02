<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Release;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class TrackSeeder extends Seeder
{
    public function run(): void
    {
        $releases = Release::all();

        $data = [];

        foreach ($releases as $release) {
            for ($i = 0; $i < $release->track_count; $i++) {
                $uuid = Str::uuid();
                $title = fake()->word();
                $duration_ms = fake()->numberBetween(30000, 600000);

                $data[] = [
                    'uuid' => $uuid,
                    'title' => $title,
                    'duration_ms' => $duration_ms,
                    "release_id" => $release->id,
                ];

                if (count($data) === 5000) {
                    DB::table('tracks')->insert($data);
                    $data = [];
                }
            }
        }

        DB::table('tracks')->insert($data);
    }
}
