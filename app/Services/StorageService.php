<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\ImageManager;

final class StorageService
{
    public static function getMediaAvatar(string $uuid, string $type): string
    {
        $folder = $type === "releases" ? "covers" : "avatars";

        return Storage::disk("public")->url("$type/$folder/$uuid.png");
    }

    public static function getReleaseCover(string $uuid): string
    {
        return Storage::disk("public")->url("releases/covers/$uuid.png");
    }

    public static function saveUserAvatar(User $user, UploadedFile $file): void
    {
        $image = ImageManager::imagick()
            ->read(input: $file);

        $image->resize(
            width: 640,
            height: 640
        );

        $encoded = $image->encode(encoder: new PngEncoder());

        Storage::disk(name: "public")->put(
            path: "/users/avatars/$user->uuid.png",
            contents: $encoded
        );
    }

    public static function deleteUserAvatar(User $user): void
    {
        Storage::disk(name: "public")
            ->delete(paths: "/users/avatars/$user->uuid.png");
    }
}
