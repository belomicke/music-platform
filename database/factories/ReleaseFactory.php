<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\FakerHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class ReleaseFactory extends Factory
{
    public function definition(): array
    {
        $uuid = Str::uuid();
        $title = $this->faker->word();
        $trackCount = $this->faker->numberBetween(1, 12);
        $releaseDate = $this->faker->date();
        $likeCount = $this->faker->numberBetween(1, 100);
        $type = $trackCount === 1 ? "single" : "album";

        $image = FakerHelpers::generateImage(letter: substr($title, 0, 2));

        Storage::disk("public")->put("releases/covers/$uuid.png", $image);

        return [
            'uuid' => $uuid,
            'title' => $title,
            'track_count' => $trackCount,
            'like_count' => $likeCount,
            'release_date' => $releaseDate,
            'type' => $type,
        ];
    }
}
