<?php

namespace Tests\Integration;

use Tests\TestCase;

class UserTest extends TestCase
{


    public function test_create_user_successufully(): void
    {
        $data = [
            "name"=> "Lucas 2 ",
            "email"=> fake()->unique()->safeEmail(),
            "taxpayer_id"=> fake()->regexify('[0-9]{11}'),
            "password"=> "123",
            "type"=> "shopkeeper",
            "balance"=> 100.2
        ]; 
        $response = $this->post("/api/user", $data);

        $response->assertStatus(201);
    }

}