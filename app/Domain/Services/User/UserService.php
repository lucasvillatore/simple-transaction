<?php 

namespace App\Domain\Services\User;

use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Entities\User\User;
use App\Domain\Exceptions\User\FailedToCreateUserException;
use App\Domain\Exceptions\User\UserNotFoundException;
use App\Domain\Exceptions\User\UserTypeNotImplementedException;
use App\Infrastructure\Repositories\User\IUserRepository;
use App\Infrastructure\Repositories\User\UserRepository;

class UserService
{
    private $repository;

    public function __construct(IUserRepository $repository = new UserRepository)
    {
        $this->repository = $repository;
    }

    public function getUserById(int $userId): User
    {
        $user = $this->repository->fetchOneById($userId);
        
        if (!$user) {
            throw new UserNotFoundException;
        }

        return $this->makeUser($user);
    }

    public function createUser(User $user) 
    {        
        $user = $this->repository->create($user);

        if (!$user) {
            throw new FailedToCreateUserException();
        }

        return $user;
    }
    
    public function makeUser(User $user)
    {
        switch($user->getType()) {
            case 'shopkeeper':
                return new ShopkeeperUser($user->toArray());
            
            case 'common':
                return new CommonUser($user->toArray());

            default:
                throw new UserTypeNotImplementedException();
        }
    }

    public function hasBalance(User $user, float $value): bool
    {
        return $user->getBalance() - $value >= 0;
    }
}