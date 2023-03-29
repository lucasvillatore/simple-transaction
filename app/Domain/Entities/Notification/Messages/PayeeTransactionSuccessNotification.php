<?php

namespace App\Domain\Entities\Notification\Messages;

class PayeeTransactionSuccessNotification
{
    private $value = 'Received transaction';

    public function getValue()
    {
        return $this->value;
    }
}