<?php

namespace Tests\Mock\User;

use App\Domain\Entities\User\User;
use App\Infrastructure\Repositories\User\IUserRepository;

class UserRepositoryMock implements IUserRepository
{
    private $users = [];

    public function create(User $user)
    {
        $user->setId(count($this->users) + 1);
        $this->users[] = $user;

        return $user;
    }

    public function fetchOneById(int $id)
    {
        return $this->users[$id - 1];
    }
}