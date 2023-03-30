<?php

namespace App\Domain\Entities\Notification\Status;

class Failed
{
    private $value = 'FAILED';

    public function getValue()
    {
        return $this->value;
    }
}