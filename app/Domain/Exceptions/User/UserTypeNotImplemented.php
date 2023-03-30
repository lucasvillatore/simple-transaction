<?php

namespace App\Domain\Exceptions\User;
use Exception;
use Throwable;

class UserTypeNotImplementedException extends Exception
{
    public function __construct($message = "User type not implemented", $code = 400, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}