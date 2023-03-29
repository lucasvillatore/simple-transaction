<?php

namespace App\Domain\Entities\Transaction\Status;

class Failed
{
    private $value = "FAILED";

    public function getValue()
    {
        return $this->value;
    }
}