<?php

namespace App\Domain\Entities\Notification\Status;

class Pending
{
    private $value = 'PENDING';

    public function getValue()
    {
        return $this->value;
    }
}