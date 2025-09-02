<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\SignInRequest;
use App\Modules\User\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

final class CreateTokenController extends Controller
{
    public function __invoke(SignInRequest $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = UserService::getByEmail(email: $email);

        if ($user === null) {
            return $this->error("User not found.", 404);
        }

        if (Hash::check($password, $user->password)) {
            $token = $user->createToken(name: "postman")->plainTextToken;

            return $this->success([
                "token" => $token
            ]);
        }

        return $this->error("Invalid credentials.");
    }
}
