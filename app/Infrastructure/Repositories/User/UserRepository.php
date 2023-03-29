<?php

namespace App\Infrastructure\Repositories\User;

use App\Domain\Entities\User\User;
use App\Domain\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{

    public function create(User $user)
    {
        $user = UserModel::create([
            'name' => $user->getName(),
            'taxpayer_id' => $user->getTaxPayerId(),
            'type' => $user->getType(),
            'email' => $user->getEmail(),
            'password' => Hash::make($user->getPassword()),
            'balance' => $user->getBalance()
        ]);

        return new User($user->toArray());
    }

    public function fetchOneById(int $userId)
    {
        $user = UserModel::find($userId);

        return new User($user->toArray());
    }
}