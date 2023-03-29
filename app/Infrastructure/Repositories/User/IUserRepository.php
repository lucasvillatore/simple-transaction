<?php

namespace App\Infrastructure\Repositories\User;

use App\Domain\Entities\User\User;

interface IUserRepository
{
    public function create(User $user);

    public function fetchOneById(int $userId);
}