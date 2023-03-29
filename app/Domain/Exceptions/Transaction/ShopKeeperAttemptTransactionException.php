<?php

namespace App\Domain\Exceptions\Transaction;
use Exception;
use Throwable;

class ShopKeeperAttemptTransactionException extends Exception
{
    public function __construct($message = "Shopkeeper can't make a transaction", $code = 409, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}