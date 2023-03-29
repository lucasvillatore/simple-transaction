<?php

namespace App\Domain\Exceptions\User;
use Exception;
use Throwable;

class UserNotFoundException extends Exception
{
    public function __construct($message = "User not found", $code = 404, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}