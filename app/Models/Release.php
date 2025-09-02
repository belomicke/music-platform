<?php

declare(strict_types=1);

namespace App\Models;

use App\Modules\Auth\Services\AuthService;
use App\Services\StorageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

/**
 * @property int id
 * @property string uuid
 * @property string title
 * @property int track_count
 * @property int like_count
 * @property string image_url
 * @property string release_date
 * @property string type
 *
 * @property bool is_followed
 *
 * @property Collection<Artist> artists
 * @property Collection<Track> tracks
 *
 * @method static create(array $attributes = [])
 */
class Release extends Model
{
    use Searchable, HasFactory;

    public function toSearchableArray(): array
    {
        return $this
            ->with("artists")
            ->where("id", $this->id)
            ->first()
            ->toArray();
    }

    public function getImageUrlAttribute(): string
    {
        return StorageService::getReleaseCover(uuid: $this->uuid);
    }

    public function is_followed(): HasOne
    {
        $id = AuthService::check() ? AuthService::user()->id : null;

        return $this->hasOne(
            related: FollowedRelease::class
        )
            ->where("user_id", $id)
            ->where("is_deleted", false);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Artist::class,
            table: "artist_release"
        );
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(related: Track::class);
    }
}
