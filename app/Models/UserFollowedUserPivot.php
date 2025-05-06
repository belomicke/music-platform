<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFollowedUserPivot extends Pivot
{
    protected $table = 'user_user';
}
