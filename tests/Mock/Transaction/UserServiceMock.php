<?php


namespace Tests\Mock\Transaction;

use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Entities\User\User;
use App\Domain\Services\User\IUserService;
use App\Infrastructure\Repositories\User\IUserRepository;
use Exception;
use Tests\Mock\User\UserRepositoryMock;

class UserServiceMock implements IUserService
{
    private $repository;

    public function __construct(IUserRepository $repository = new UserRepositoryMock)
    {
        $this->repository = $repository;
    }

    public function getUserById(int $userId): User
    {
        $user = $this->repository->fetchOneById($userId);
        
        return $this->makeUser($user);
    }

    public function createUser(User $user)
    {
        return $this->repository->create($user);
    }
    
    public function makeUser(User $user)
    {
        switch($user->getType()) {
            case 'shopkeeper':
                return new ShopkeeperUser($user->toArray());
                
            case 'common':
                return new CommonUser($user->toArray());

            default:
                throw new Exception();
        }
    }

    public function hasBalance(User $user, float $value): bool
    {
        return $user->getBalance() >= $value;
    }
}