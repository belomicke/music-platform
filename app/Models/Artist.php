<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string uuid
 * @property string name
 * @property int followers_count
 */
class Artist extends Model
{
    protected $fillable = [
        'uuid',
        'name',
    ];
}
