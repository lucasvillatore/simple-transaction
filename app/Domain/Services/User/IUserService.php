<?php 

namespace App\Domain\Services\User;

use App\Domain\Entities\User\User;

interface IUserService
{
    public function getUserById(int $userId): User;

    public function createUser(User $user);
    
    public function makeUser(User $user);

    public function hasBalance(User $user, float $value): bool;
}