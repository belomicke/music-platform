<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        Artist::factory(100)->create();
    }
}
