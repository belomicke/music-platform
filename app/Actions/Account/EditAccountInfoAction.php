<?php

declare(strict_types=1);

namespace App\Actions\Account;

use App\Models\User;
use App\Services\StorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

final class EditAccountInfoAction
{
    public function execute(string|null $name, UploadedFile|null $avatar): User
    {
        $user = Auth::user();

        if ($name !== null) {
            $user->name = $name;
        }

        if ($avatar !== null) {
            StorageService::deleteUserAvatar(user: $user);
            StorageService::saveUserAvatar(user: $user, file: $avatar);
        }

        $user->save();

        return $user->fresh();
    }
}
