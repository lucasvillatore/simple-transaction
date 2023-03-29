<?php

namespace Tests\Unit\Services\User;

use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Entities\User\User;
use App\Domain\Services\User\UserService as Service;
use PHPUnit\Framework\TestCase;
use Tests\Mock\User\UserRepositoryMock;

class UserServiceTest extends TestCase
{
    private static $repository;

    public static function setUpBeforeClass(): void
    {
        self::$repository = new UserRepositoryMock();

        self::$repository->create(
            new User([
                'name' => 'Lucas',
                'taxpayer_id' => '1234567890',
                'email' => 'lucas@gmail.com',
                'password' => 'senhaforte',
                'balance' => 123,
                'type' => 'common'
            ])
        );

        self::$repository->create(
            new User([
                'name' => 'Lucas',
                'taxpayer_id' => '12345678902',
                'email' => 'lucas2@gmail.com',
                'password' => 'senhaforte',
                'balance' => 123,
                'type' => 'shopkeeper'
            ])
        );
    }

    public function test_getUserById()
    {
        $service = (new Service(self::$repository));

        $user = $service->getUserById(1);

        $expected = new CommonUser([
            'id' => 1,
            'name' => 'Lucas',
            'email' => 'lucas@gmail.com',
            'taxpayer_id' => '1234567890',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'common'
        ]);

        $this->assertEquals($expected, $user);
    }

    public function test_create()
    {
        $service = (new Service(self::$repository));

        $user = new User([
            'name' => 'Teste',
            'taxpayer_id' => '12345678905',
            'email' => 'lucas4@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'shopkeeper'
        ]);

        $expected = $service->createUser($user);

        $this->assertEquals($expected, $user);
    }

    public function test_makeUser()
    {
        $service = (new Service(self::$repository));

        $user = new User([
            'name' => 'Teste',
            'taxpayer_id' => '12345678906',
            'email' => 'lucas5@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'shopkeeper'
        ]);
        
        $user = $service->makeUser($user);

        $expected = new ShopkeeperUser([
            'name' => 'Teste',
            'taxpayer_id' => '12345678906',
            'email' => 'lucas5@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'shopkeeper'
        ]);

        $this->assertEquals($expected, $user);
    }

    public function test_hasBalance()
    {
        $service = (new Service(self::$repository));

        $user = new User([
            'id' => 1,
            'name' => 'Teste',
            'taxpayer_id' => '12345678906',
            'email' => 'lucas5@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'common'
        ]);

        $expected = True;

        $received = $service->hasBalance($user, 100);

        $user = new User([
            'id' => 2,
            'name' => 'Teste',
            'taxpayer_id' => '12345678906',
            'email' => 'lucas5@gmail.com',
            'password' => 'senhaforte',
            'balance' => 0,
            'type' => 'common'
        ]);

        $expected = False;

        $received = $service->hasBalance($user, 100);

        $this->assertEquals($expected, $received);
    }

}