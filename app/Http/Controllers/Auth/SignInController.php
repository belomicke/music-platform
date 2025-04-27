<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SignInAction;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Resources\User\CurrentUserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

final class SignInController extends Controller
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

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

        $user = $this->users->getByEmail(email: $data->email);

        return $this->success([
            "user" => CurrentUserResource::make($user)
        ]);
    }
}
