<?php

namespace App\Domain\Entities\Transaction\Status;

class InProgress
{
    private $value = "IN_PROGRESS";

    public function getValue()
    {
        return $this->value;
    }
}