<?php

namespace App\Domain\Entities\Notification\Messages;

class PayerTransactionSuccessNotification
{
    private $value = 'Transaction done successufully';

    public function getValue()
    {
        return $this->value;
    }
}