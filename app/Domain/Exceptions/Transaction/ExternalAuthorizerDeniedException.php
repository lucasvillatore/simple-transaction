<?php

namespace App\Domain\Exceptions\Transaction;
use Exception;
use Throwable;

class ExternalAuthorizerDeniedException extends Exception
{
    public function __construct($message = "Denied transaction from external authorizer", $code = 400, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}