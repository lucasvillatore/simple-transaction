<?php

namespace Tests\Unit\Services\Transaction\Validators;

use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\User;
use App\Domain\Services\Transaction\Validators\UserTransactionService;
use PHPUnit\Framework\TestCase;
use Tests\Mock\Transaction\UserServiceMock;

class UserTransactionServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_validate(): void
    {
        $service = new UserTransactionService(new UserServiceMock);

        $user = new User([
            'name' => 'Lucas',
            'taxpayer_id' => '1234567890',
            'email' => 'lucas@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'common'
        ]);

        $transaction = new Transaction([
            'value' => 10,
            'payer_id' => 1,
            'payee_id' => 1
        ]);


        $expected = True;
        $received = $service->validate($transaction, $user);

        $this->assertEquals($expected, $received);
    }
}
