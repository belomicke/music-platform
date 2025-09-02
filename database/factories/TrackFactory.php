<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\FakerHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class TrackFactory extends Factory
{
    public function definition(): array
    {
        $uuid = Str::uuid();
        $title = $this->faker->word();
        $duration_ms = $this->faker->numberBetween(30000, 600000);

        $image = FakerHelpers::generateImage(letter: substr($title, 0, 2));

        Storage::disk("public")->put("releases/covers/$uuid.png", $image);

        return [
            'uuid' => $uuid,
            'title' => $title,
            'duration_ms' => $duration_ms,
            'like_count' => $likeCount,
            'release_date' => $releaseDate,
            'type' => $type,
        ];
    }
}
