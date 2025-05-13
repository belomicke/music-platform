<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

/**
 * @property int id
 * @property string uuid
 * @property string name
 * @property int followers_count
 * @property string image_url
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
        return [
            "name" => $this->name,
        ];
    }

    public function getImageUrlAttribute()
    {
        return Storage::disk("public")->url("artists/avatars/$this->uuid.png");
    }

    public function is_followed(): HasOne
    {
        $id = Auth::user()->id ?? 0;

        return $this->hasOne(UserFollowedArtistPivot::class)
            ->where("user_id", $id);
    }
}
