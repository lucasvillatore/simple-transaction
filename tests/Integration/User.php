<?php

namespace Tests\Integration;

use Tests\TestCase;

class User extends TestCase
{


    public function test_create_user_successufully(): void
    {
        $response = $this->post("/api/user");

        $response->assertStatus(201);
    }

    public function test_list_all_users(): void
    {
        $response = $this->get("/api/user");

        $response->status(200);
    }
}