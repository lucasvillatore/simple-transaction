<?php

namespace Tests\Unit\Services\Transaction;

use App\Domain\Entities\Transaction\Status\Completed;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Entities\User\User;
use App\Domain\Exceptions\Transaction\TransactionValidatorNotImplementedException;
use App\Domain\Exceptions\Transaction\UserHasNoBalanceException;
use App\Domain\Services\Notification\NotificationService;
use App\Domain\Services\Transaction\TransactionService;
use App\Domain\Services\Transaction\Validators\ShopkeeperTransactionService;
use App\Domain\Services\Transaction\Validators\UserTransactionService;
use App\Domain\Services\User\UserService;
use Tests\Mock\Transaction\TransactionRepositoryMock;

use Tests\TestCase;
use Tests\Mock\Notification\NotificationRepositoryMock;
use Tests\Mock\User\UserRepositoryMock;

class TransactionServiceTest extends TestCase
{
    private static $repository;
    private static $userService;
    private static $notificationService;
    private static $notificationRepositoryMock;
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
        
        self::$userService = new UserService(self::$userRepositoryMock);
        self::$repository = new TransactionRepositoryMock();
        self::$notificationRepositoryMock = new NotificationRepositoryMock();
        self::$notificationService = new NotificationService(self::$notificationRepositoryMock, "http://o4d9z.mocklab.io/notify");

    }
    public function test_create()
    {
        $service = new TransactionService(self::$repository, self::$userService, self::$notificationService);

        $transaction = new Transaction([
            "value" => 10,
            "payer_id" => 1,
            "payee_id" => 2
        ]);

        $transaction->setStatus((new Completed)->getValue());
        
        $expected = $service->create($transaction);

        $this->assertEquals($expected, $transaction);

        $this->expectException(UserHasNoBalanceException::class);
        $transaction = new Transaction([
            "value" => 10000,
            "payer_id" => 1,
            "payee_id" => 2
        ]);

        $transaction->setStatus((new Completed)->getValue());
        
        $expected = $service->create($transaction);
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

        $userUnknown = new User([
            'name' => 'Lucas',
            'taxpayer_id' => '1234567890',
            'email' => 'lucas@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'unknown'
        ]);

        $service = new TransactionService(
            new TransactionRepositoryMock,
            self::$userService,
            self::$notificationService
        );

        $received = $service->getTransactionValidatorService($userCommon);
        $expected = UserTransactionService::class;
        
        $this->assertInstanceOf($expected, $received);
        
        $expected = ShopkeeperTransactionService::class;
        $received = $service->getTransactionValidatorService($userShopkeeper);
        $this->assertInstanceOf($expected, $received);

        $this->expectException(TransactionValidatorNotImplementedException::class);
        $received = $service->getTransactionValidatorService($userUnknown);
    }

    
}
