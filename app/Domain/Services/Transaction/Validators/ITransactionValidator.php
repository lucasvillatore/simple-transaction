<?php

namespace App\Domain\Services\Transaction\Validators;

use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\User;

interface ITransactionValidator
{
    public function validate(Transaction $transaction, User $user);
}