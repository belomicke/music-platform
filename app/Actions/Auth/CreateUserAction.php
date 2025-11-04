<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\CreateUserDTO;
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
        $this->checkVerificationCode(
            email: $data->email,
            code: $data->verification_code
        );

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

    /**
     * @throws InvalidVerificationCodeException
     */
    private function checkVerificationCode(string $email, string $code): void
    {
        $isValid = $this->emailVerificationCodes->getByEmail(email: $email)->code === $code;

        if ($isValid === false) {
            throw new InvalidVerificationCodeException();
        }
    }
}
