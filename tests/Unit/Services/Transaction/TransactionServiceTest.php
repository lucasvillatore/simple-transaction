<?php

namespace Tests\Unit\Services\Transaction;

use App\Domain\Entities\Transaction\Status\Completed;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Entities\User\User;
use App\Domain\Services\Transaction\TransactionService;
use App\Domain\Services\Transaction\Validators\ShopkeeperTransactionService;
use App\Domain\Services\Transaction\Validators\UserTransactionService;

use Tests\Mock\Transaction\TransactionRepositoryMock;
use Tests\Mock\Transaction\UserServiceMock;
use Tests\Mock\Transaction\NotificationServiceMock;

use PHPUnit\Framework\TestCase;
use Tests\Mock\User\UserRepositoryMock;

class TransactionServiceTest extends TestCase
{
    private static $repository;
    private static $userServiceMock;
    private static $notificationServiceMock;
    private static $userRepositoryMock;

    public static function setUpBeforeClass(): void
    {
        self::$userRepositoryMock = new UserRepositoryMock();
        self::$userRepositoryMock->create(
            new User([
                'name' => 'Lucas',
                'taxpayer_id' => '1234567890',
                'email' => 'lucas@gmail.com',
                'password' => 'senhaforte',
                'balance' => 123,
                'type' => 'common'
            ])
        );

        self::$userRepositoryMock->create(
            new User([
                'name' => 'Lucas',
                'taxpayer_id' => '1234567891',
                'email' => 'lucas1@gmail.com',
                'password' => 'senhaforte',
                'balance' => 123,
                'type' => 'shopkeeper'
            ])
        );

        self::$userServiceMock = new UserServiceMock(self::$userRepositoryMock);
        self::$repository = new TransactionRepositoryMock();
        self::$notificationServiceMock = new NotificationServiceMock();

    }
    public function test_create()
    {
        $service = new TransactionService(self::$repository, self::$userServiceMock, self::$notificationServiceMock);

        $transaction = new Transaction([
            "value" => 10,
            "payer_id" => 1,
            "payee_id" => 2
        ]);

        $transaction->setStatus((new Completed)->getValue());
        
        $expected = $service->create($transaction);

        $this->assertEquals($expected, $transaction);
    }


    /**
     * A basic test example.
     */
    public function test_getTransactionValidator(): void
    {

        $userCommon = new CommonUser([
            'name' => 'Lucas',
            'taxpayer_id' => '1234567890',
            'email' => 'lucas@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'common'
        ]);

        $userShopkeeper = new ShopkeeperUser([
            'name' => 'Lucas',
            'taxpayer_id' => '1234567890',
            'email' => 'lucas@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'shopkeeper'
        ]);

        $service = new TransactionService(
            new TransactionRepositoryMock,
            new UserServiceMock,
            new NotificationServiceMock
        );

        $received = $service->getTransactionValidatorService($userCommon);
        $expected = UserTransactionService::class;
        
        $this->assertInstanceOf($expected, $received);
        
        $expected = ShopkeeperTransactionService::class;
        $received = $service->getTransactionValidatorService($userShopkeeper);
        $this->assertInstanceOf($expected, $received);
    }

    
}
