<?php

namespace Tests\Unit\Entities\User;

use App\Domain\Entities\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function test_User()
    {
        $data = [
            'id' => 1,
            'name' => 'Teste',
            'taxpayer_id' => '12345678906',
            'email' => 'lucas5@gmail.com',
            'password' => 'senhaforte',
            'balance' => 123,
            'type' => 'common'
        ];

        $user = new User($data);

        $this->assertEquals($data, $user->toArray());
    }
}