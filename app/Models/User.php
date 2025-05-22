<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\StorageService;
use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string uuid
 * @property string username
 * @property string email
 * @property string password
 * @property string image_url
 * @property int followed_artists_count
 * @property int followed_releases_count
 * @property int favorite_tracks_count
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
        return StorageService::getMediaAvatar(
            uuid: $this->uuid,
            type: "users"
        );
    }

    public function followed_artists(): BelongsToMany
    {
        return $this->belongsToMany(
            Artist::class,
            "artist_user"
        )->withTimestamps();
    }

    public function followed_releases(): BelongsToMany
    {
        return $this->belongsToMany(
            Release::class,
            "release_user"
        )->withTimestamps();
    }

    public function favorite_tracks(): BelongsToMany
    {
        return $this->belongsToMany(
            Track::class,
            "track_user"
        )->withTimestamps();
    }

    public function recent_searches(): HasMany
    {
        return $this->HasMany(RecentSearch::class);
    }
}
