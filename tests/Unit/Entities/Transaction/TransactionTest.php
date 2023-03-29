<?php

namespace Tests\Unit\Entities\Transaction;

use App\Domain\Entities\Transaction\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{

    public function test_Transaction()
    {
        $data = [
            'id' => 1,
            'value' => 123,
            'payer' => 1,
            'payee' => 2,
            'status' => null
        ];

        $transaction = new Transaction([
            'id' => 1,
            'value' => 123,
            'payer_id' => 1,
            'payee_id' => 2,
            'status' => null
        ]);

        $this->assertEquals($data, $transaction->toArray());
    }
}