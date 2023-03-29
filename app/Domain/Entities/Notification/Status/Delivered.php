<?php

namespace App\Domain\Entities\Notification\Status;

class Delivered
{
    private $value = 'DELIVERED';

    public function getValue()
    {
        return $this->value;
    }
}