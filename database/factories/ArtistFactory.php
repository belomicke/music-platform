<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Artist>
 */
class ArtistFactory extends Factory
{
    public function definition(): array
    {
        $oneMillion = 1000000;

        return [
            'uuid' => Str::uuid(),
            'name' => $this->faker->name(),
            'followers_count' => $this->faker->numberBetween(0, $oneMillion),
        ];
    }
}
