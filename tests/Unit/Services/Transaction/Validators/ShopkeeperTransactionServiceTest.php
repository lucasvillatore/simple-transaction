<?php

namespace Tests\Unit\Services\Transaction\Validators;

use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\User;
use App\Domain\Exceptions\Transaction\ShopKeeperAttemptTransactionException;
use App\Domain\Services\Transaction\Validators\ShopkeeperTransactionService;
use PHPUnit\Framework\TestCase;

class ShopkeeperTransactionServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_validate(): void
    {
        $this->expectException(ShopKeeperAttemptTransactionException::class);        
        
        $service = new ShopkeeperTransactionService();
            
        $user = new User([
                'name' => 'Lucas',
                'taxpayer_id' => '1234567890',
                'email' => 'lucas@gmail.com',
                'password' => 'senhaforte',
                'balance' => 123,
                'type' => 'shopkeeper'
            ]);
    
        $transaction = new Transaction([
            'value' => 10,
            'payer_id' => 1,
            'payee_id' => 1
        ]);
    
    
        $service->validate($transaction, $user);
    }
}
