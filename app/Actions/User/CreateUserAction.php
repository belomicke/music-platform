<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTO\User\CreateUserDTO;
use App\Exceptions\Auth\InvalidVerificationCodeException;
use App\Models\User;
use App\Queries\EmailVerificationCode\DeleteEmailVerificationCodeQuery;
use App\Queries\EmailVerificationCode\GetEmailVerificationCodeQuery;
use App\Queries\User\CreateUserQuery;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class CreateUserAction
{
    public function __construct(
        private CreateUserQuery                  $createUserQuery,
        private GetEmailVerificationCodeQuery    $getEmailVerificationCodeQuery,
        private DeleteEmailVerificationCodeQuery $deleteEmailVerificationCodeQuery,
    ) {}

    /**
     * @throws Exception|Throwable|InvalidVerificationCodeException
     */
    public function execute(CreateUserDTO $data): User
    {
        $verificationCodeIsValid = $this->checkVerificationCode(
            email: $data->email,
            code: $data->verificationCode
        );

        if ($verificationCodeIsValid === false) {
            throw new InvalidVerificationCodeException();
        }

        try {
            DB::beginTransaction();

            $user = $this->createUserQuery->execute(data: $data);
            $this->deleteEmailVerificationCodeQuery->execute(email: $data->email);

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            if (config("app.debug")) {
                throw $e;
            }

            throw new Exception("Internal Server Error.");
        }
    }

    private function checkVerificationCode(string $email, string $code): bool
    {
        return $this->getEmailVerificationCodeQuery->execute(email: $email) === $code;
    }
}
