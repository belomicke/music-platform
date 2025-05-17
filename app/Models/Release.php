<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\AuthService;
use App\Services\StorageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
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
 * @property Collection artists
 *
 * @method static create(array $attributes = [])
 */
class Release extends Model
{
    use Searchable;

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
        return StorageService::getMediaAvatar(
            uuid: $this->uuid,
            type: "releases"
        );
    }

    public function is_followed(): HasOne
    {
        $id = AuthService::user()->id ?? 0;

        return $this->hasOne(UserFollowedReleasesPivot::class)
            ->where("user_id", $id);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Artist::class,
            table: "artist_release"
        );
    }
}
