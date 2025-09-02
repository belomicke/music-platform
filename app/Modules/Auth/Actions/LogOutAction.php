<?php

declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LogOutAction
{
    public function execute(Request $request): void
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
