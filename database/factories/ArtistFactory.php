<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\FakerHelpers;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * @throws ConnectionException
     */
    public function definition(): array
    {
        $uuid = Str::uuid();
        $name = $this->faker->name();

        $image = FakerHelpers::generateImage(letter: substr($name, 0, 1));

        Storage::disk("public")->put("artists/avatars/$uuid.png", $image);

        return [
            'uuid' => $uuid,
            'name' => $name,
            'followers_count' => 1,
        ];
    }
}
