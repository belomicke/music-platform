<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\DTOs\User\CreateUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class CreateUserQuery
{
    public function execute(CreateUserDTO $data): User
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
