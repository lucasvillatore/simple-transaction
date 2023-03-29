<?php

namespace App\Domain\Exceptions\Transaction;
use Exception;
use Throwable;

class ExternalAuthorizerDeniedExceptionTest extends Exception
{
    public function __construct($message = "Denied transaction from external authorizer", $code = 409, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}