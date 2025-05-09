<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk("public")->deleteDirectory("artists");
        Storage::disk("public")->makeDirectory("artists/avatars");

        Storage::disk("public")->deleteDirectory("users");
        Storage::disk("public")->makeDirectory("users/avatars");

        $this->call([
            UserSeeder::class,
            UserFollowingSeeder::class,
            ArtistSeeder::class,
            ArtistFollowingSeeder::class
        ]);
    }
}
