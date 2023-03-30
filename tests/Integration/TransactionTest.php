<?php

namespace Tests\Integration;

use App\Domain\Entities\User\User;
use App\Infrastructure\Repositories\User\UserRepository;
use Tests\TestCase;

class TransactionTest extends TestCase
{


    public function test_create_transaction_successufully(): void
    {
        $user = (new UserRepository)->create(new User([
            "name"=> "Lucas 2 ",
            "email"=> fake()->unique()->safeEmail(),
            "taxpayer_id"=> fake()->regexify('[0-9]{11}'),
            "password"=> "123",
            "type"=> "common",
            "balance"=> 100.2
        ]));

        $userPayee = (new UserRepository)->create(new User([
            "name"=> "Lucas 2 ",
            "email"=> fake()->unique()->safeEmail(),
            "taxpayer_id"=> fake()->regexify('[0-9]{11}'),
            "password"=> "123",
            "type"=> "common",
            "balance"=> 100.2
        ]));

        $data = [
            'value' => 1,
            'payer_id' => $user->getId(),
            'payee_id' => $userPayee->getId()
        ]; 
        $response = $this->post("/api/transaction", $data);

        $response->assertStatus(201);
    }

}