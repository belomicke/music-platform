<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTOs\User\CreateUserDTO;
use App\Exceptions\Auth\InvalidVerificationCodeException;
use App\Models\User;
use App\Repositories\EmailVerificationCodeRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class CreateUserAction
{
    public function __construct(
        private UserRepository                  $users,
        private EmailVerificationCodeRepository $emailVerificationCodes,
    ) {}

    /**
     * @throws Exception|Throwable|InvalidVerificationCodeException
     */
    public function execute(CreateUserDTO $data): User
    {
        $verificationCodeIsValid = $this->checkVerificationCode(
            email: $data->email,
            code: $data->verification_code
        );

        if ($verificationCodeIsValid === false) {
            throw new InvalidVerificationCodeException();
        }

        try {
            DB::beginTransaction();

            $user = $this->users->create(data: $data);
            $this->emailVerificationCodes->delete(email: $data->email);

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
        return $this->emailVerificationCodes->getByEmail(email: $email) === $code;
    }
}
