<?php


namespace Tests\Mock\Transaction;

use App\Domain\Entities\Transaction\Status\Completed;
use App\Domain\Entities\Transaction\Transaction;
use App\Infrastructure\Repositories\Transaction\ITransactionRepository;

class TransactionRepositoryMock implements ITransactionRepository
{
    private $transactions = [];

    public function create(Transaction $transaction)
    {
        $transaction->setId(count($this->transactions) + 1);
        $transaction->setStatus((new Completed)->getValue());
        $this->transactions[] = $transaction;

        return $transaction;
    }
}