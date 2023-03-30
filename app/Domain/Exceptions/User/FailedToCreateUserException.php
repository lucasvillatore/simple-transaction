<?php

namespace App\Domain\Exceptions\User;
use Exception;
use Throwable;

class FailedToCreateUserException extends Exception
{
    public function __construct($message = "Failed to create user", $code = 400, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}