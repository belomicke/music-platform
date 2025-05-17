<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Release;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class ReleaseSeeder extends Seeder
{
    public function run(): void
    {
        Release::create([
            "uuid" => Str::uuid(),
            "title" => "Protect The Land / Genocidal Humanoidz",
            "track_count" => 2,
            "release_date" => "2020-11-06 00:00:00",
            "like_count" => 7458,
            "type" => "album"
        ]);
    }
}
