<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Models\User;
use App\Modules\Auth\DTOs\CreateUserDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserRepository
{
    public static function getByEmail(string $email): User|null
    {
        return User::query()->where("email", $email)->first();
    }

    public function create(CreateUserDTO $data): User
    {
        $user = new User();

        $date = now();

        $user->uuid = Str::uuid()->toString();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make(value: $data->password);
        $user->email_verified_at = $date;
        $user->updated_at = $date;
        $user->created_at = $date;

        $user->save();

        return $user->fresh();
    }
}
