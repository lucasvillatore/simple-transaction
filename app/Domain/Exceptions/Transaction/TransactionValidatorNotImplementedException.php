<?php

namespace App\Domain\Exceptions\Transaction;

use Exception;
use Throwable;

class TransactionValidatorNotImplementedException extends Exception
{
    public function __construct($message = "Transaction validator not implemented", $code = 400, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}