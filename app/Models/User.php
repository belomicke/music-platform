<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string uuid
 * @property string username
 * @property string email
 * @property string password
 * @property int followed_artists_count
 * @property int followed_users_count
 * @property int followers_count
 * @property bool is_followed
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

    public function is_followed(): HasOne
    {
        $id = Auth::user()->id ?? 0;

        return $this->hasOne(
            UserFollowedUserPivot::class,
            "followed_user_id",
            "id"
        )
            ->where("following_user_id", $id);
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

    public function followed_users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "user_user",
            "following_user_id",
            "followed_user_id",
        )->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "user_user",
            "followed_user_id",
            "following_user_id",
        )->withTimestamps();
    }
}
