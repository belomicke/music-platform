<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\SignInAction;
use App\Modules\Auth\Exceptions\InvalidCredentialsException;
use App\Modules\Auth\Http\Requests\SignInRequest;
use App\Modules\Auth\Http\Resources\CurrentUserResource;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;

final class SignInController extends Controller
{
    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(
        SignInRequest $request,
        SignInAction  $signInAction
    ): JsonResponse
    {
        $data = $request->toDTO();

        $signInAction->execute(data: $data);

        $user = AuthService::user();

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
