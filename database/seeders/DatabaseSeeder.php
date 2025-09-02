<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk("public")->deleteDirectory("artists");
        Storage::disk("public")->makeDirectory("artists/avatars");

        Storage::disk("public")->deleteDirectory("users");
        Storage::disk("public")->makeDirectory("users/avatars");

        Storage::disk("public")->deleteDirectory("releases");
        Storage::disk("public")->makeDirectory("releases/covers");

        $this->call([
            UserSeeder::class,
            ArtistSeeder::class,
            ArtistFollowingSeeder::class,
            ReleaseSeeder::class,
            TrackSeeder::class,
            ArtistTrackSeeder::class
        ]);
    }
}
