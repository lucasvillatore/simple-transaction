<?php

namespace App\Domain\Services\Transaction\Validators;

use App\Domain\Entities\User\User;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Services\Transaction\Validators\ITransactionValidator;
use App\Domain\Exceptions\Transaction\UserHasNoBalanceException;
use App\Domain\Services\User\UserService;

class UserTransactionService implements ITransactionValidator
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function validate(Transaction $transaction, User $user)
    {
        if (!$this->service->hasBalance($user, $transaction->getValue())) {
            throw new UserHasNoBalanceException();
        }

        return true;
    }
}