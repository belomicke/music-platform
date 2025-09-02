<?php

declare(strict_types=1);

namespace App\Models;

use App\Modules\Auth\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property Release release
 * @property Collection<Artist> artists
 */
final class Track extends Model
{
    use Searchable;

    public function toSearchableArray(): array
    {
        return $this
            ->with(["artists", "release"])
            ->where("id", $this->id)
            ->first()
            ->toArray();
    }

    public function is_favorite(): HasOne
    {
        $id = AuthService::check() ? AuthService::user()->id : null;

        return $this->hasOne(
            related: FavoriteTrack::class
        )
            ->where("user_id", $id)
            ->where("is_deleted", false);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Artist::class,
            table: "artist_track"
        );
    }

    public function release(): BelongsTo
    {
        return $this->belongsTo(
            related: Release::class,
            foreignKey: "release_id"
        );
    }
}
