<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class FollowedArtist extends Pivot
{
    protected $table = 'artist_user';
}
