<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 * @property string uuid
 * @property string name
 * @property int followers_count
 *
 * @property HasOne is_followed
 */
class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
    ];

    protected $hidden = [
        "pivot"
    ];

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function is_followed(): HasOne
    {
        $id = Auth::user()->id ?? 0;

        return $this->hasOne(UserFollowedArtistPivot::class)
            ->where("user_id", $id);
    }
}
