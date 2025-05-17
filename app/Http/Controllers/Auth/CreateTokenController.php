<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SignInRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::query()->where('email', $email)->first();

        if ($user === null) {
            throw new NotFoundHttpException();
        }

        if (Hash::check($password, $user->password)) {
            $token = $user->createToken(name: "postman")->plainTextToken;

            return $this->success([
                "token" => $token
            ]);
        }
    }
}
