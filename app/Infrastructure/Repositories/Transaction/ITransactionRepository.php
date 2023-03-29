<?php

namespace App\Infrastructure\Repositories\Transaction;

use App\Domain\Entities\Transaction\Transaction;

interface ITransactionRepository
{
    public function create(Transaction $transaction);
}