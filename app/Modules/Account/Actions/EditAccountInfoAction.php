<?php

declare(strict_types=1);

namespace App\Modules\Account\Actions;

use App\Models\User;
use App\Modules\Auth\Services\AuthService;
use App\Services\StorageService;
use Illuminate\Http\UploadedFile;

final class EditAccountInfoAction
{
    public function execute(string|null $name, UploadedFile|null $avatar): User
    {
        $user = AuthService::user();

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
