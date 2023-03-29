<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Entities\User\User;
use App\Domain\Services\User\UserService;
use App\Interfaces\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct (UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserCreateRequest $request) 
    {
        $user = $this->userService->createUser(
            new User($request->toArray())
        );

        return response()->json($user, 201);
    }
}
