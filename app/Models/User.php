<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string uuid
 * @property string username
 * @property string email
 * @property string password
 * @property string image_url
 * @property int followed_artists_count
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, CanResetPassword;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        "image_url"
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk("public")->url("users/avatars/$this->uuid.png");
    }

    public function followed_artists(): BelongsToMany
    {
        return $this->belongsToMany(
            Artist::class,
            "artist_user",
            "user_id",
            "artist_id"
        )->withTimestamps();
    }
}
