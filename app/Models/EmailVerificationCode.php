<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string email
 * @property string code
 */
final class EmailVerificationCode extends Model
{
    public $fillable = [
        "email",
        "code"
    ];
}
