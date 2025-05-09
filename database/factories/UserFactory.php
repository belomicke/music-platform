<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\FakerHelpers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws ConnectionException
     */
    public function definition(): array
    {
        $uuid = Str::uuid();
        $name = fake()->name();
        $image = FakerHelpers::generateImage(letter: substr($name, 0, 1));

        Storage::disk("public")->put("users/avatars/$uuid.png", $image);

        return [
            'uuid' => $uuid,
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            "followers_count" => 99,
            "followed_users_count" => 99,
            "followed_artists_count" => 100
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
