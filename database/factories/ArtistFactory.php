<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\FakerHelpers;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Artist>
 */
final class ArtistFactory extends Factory
{
    public function definition(): array
    {
        $uuid = Str::uuid();
        $name = $this->faker->name();
        $releasesCount = $this->faker->numberBetween(1, 12);

        $image = FakerHelpers::generateImage(letter: substr($name, 0, 1));

        Storage::disk("public")->put("artists/avatars/$uuid.png", $image);

        return [
            "uuid" => $uuid,
            "name" => $name,
            "release_count" => $releasesCount,
        ];
    }
}
