<?php

declare(strict_types=1);

namespace App\Modules\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Account\Actions\EditAccountInfoAction;
use App\Modules\Auth\Http\Resources\CurrentUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class EditAccountInfoController extends Controller
{
    public function __invoke(
        Request               $request,
        EditAccountInfoAction $editAccountInfoAction
    ): JsonResponse
    {
        $name = $request->input("name");
        $avatar = $request->file("avatar");

        $user = $editAccountInfoAction->execute(
            name: $name,
            avatar: $avatar
        );

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
