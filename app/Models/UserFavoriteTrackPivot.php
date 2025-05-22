<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class UserFavoriteTrackPivot extends Pivot
{
    protected $table = "track_user";
}
