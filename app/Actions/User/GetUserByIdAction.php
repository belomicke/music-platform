<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Queries\User\GetUserByIdQuery;

final readonly class GetUserByIdAction
{
    public function __construct(
        private GetUserByIdQuery $getUserByIdQuery
    ) {}

    /**
     * @throws UserNotFoundException
     */
    public function execute(string $id): User
    {
        $user = $this->getUserByIdQuery->execute(id: $id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
