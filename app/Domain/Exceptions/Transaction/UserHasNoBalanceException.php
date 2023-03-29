<?php

namespace App\Domain\Exceptions\Transaction;
use Exception;
use Throwable;

class UserHasNoBalanceException extends Exception
{
    public function __construct($message = "User doens't have balance to make transaction", $code = 409, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}