<?php

namespace App\Domain\Entities\Transaction\Status;

class Completed
{
    private $value = "COMPLETED";

    public function getValue()
    {
        return $this->value;
    }
}