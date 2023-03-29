<?php

namespace App\Domain\Exceptions\Transaction;
use Exception;
use Throwable;

class FailedToSendNotificationException extends Exception
{
    public function __construct($message = "Failed to send notification", $code = 400, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}