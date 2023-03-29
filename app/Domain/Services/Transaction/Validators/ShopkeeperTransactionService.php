<?php

namespace App\Domain\Services\Transaction\Validators;

use App\Domain\Entities\User\User;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Services\Transaction\Validators\ITransactionValidator;
use App\Domain\Exceptions\Transaction\ShopKeeperAttemptTransactionException;

class ShopkeeperTransactionService implements ITransactionValidator
{
    
    public function validate(Transaction $transaction, User $user)
    {
        throw new ShopKeeperAttemptTransactionException();
    }
}