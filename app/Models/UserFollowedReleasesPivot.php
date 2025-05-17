<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFollowedReleasesPivot extends Pivot
{
    protected $table = "release_user";
}
