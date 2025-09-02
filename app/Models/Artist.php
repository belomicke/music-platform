<?php

declare(strict_types=1);

namespace App\Models;

use App\Modules\Auth\Services\AuthService;
use App\Services\StorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;

/**
 * @property int id
 * @property string uuid
 * @property string name
 * @property int release_count
 * @property string image_url
 *
 * @property Collection<Release> releases
 *
 * @property HasOne is_followed
 */
class Artist extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        "uuid",
        "name",
    ];

    protected $hidden = [
        "pivot"
    ];

    protected $appends = [
        "image_url"
    ];

    public function toSearchableArray(): array
    {
        return $this
            ->with("releases")
            ->where("id", $this->id)
            ->first()
            ->toArray();
    }

    public function getImageUrlAttribute()
    {
        return StorageService::getMediaAvatar(
            uuid: $this->uuid,
            type: "artists"
        );
    }

    public function is_followed(): HasOne
    {
        $id = AuthService::check() ? AuthService::user()->id : null;

        return $this->hasOne(
            related: FollowedArtist::class
        )
            ->where("user_id", $id)
            ->where("is_deleted", false);
    }

    public function releases(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Release::class,
            table: "artist_release"
        );
    }
}
