<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

/**
 * @property int id
 * @property string uuid
 * @property string title
 * @property int duration_ms
 *
 * @property HasOne is_favorite
 *
 * @property Collection<Artist> artists
 * @property Collection<Release> releases
 */
final class Track extends Model
{
    use Searchable;

    public function toSearchableArray(): array
    {
        return $this
            ->with(["artists", "releases"])
            ->where("id", $this->id)
            ->first()
            ->toArray();
    }

    public function is_favorite(): HasOne
    {
        $id = AuthService::user()->id ?? 0;

        return $this->hasOne(UserFavoriteTrackPivot::class)
            ->where("user_id", $id);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Artist::class,
            table: "artist_track"
        );
    }

    public function releases(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Release::class,
            table: "release_track"
        );
    }
}
