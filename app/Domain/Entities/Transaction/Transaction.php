<?php

namespace App\Domain\Entities\Transaction;


class Transaction
{
    private $id;

    private $value;

    private $payer;

    private $payee;

    private $status;

    public function __construct(array $data)
    {
        $this->setId($data['id'] ?? null);
        $this->setValue($data['value']);
        $this->setPayer($data['payer_id']);
        $this->setPayee($data['payee_id']);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getValue():float
    {
        return $this->value;
    }

    public function getPayer(): int 
    {
        return $this->payer;
    }

    public function getPayee(): int
    {
        return $this->payee;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setValue(float $value): void 
    {
        $this->value = $value;
    }
    public function setPayer(int $payer): void 
    {
        $this->payer = $payer;
    }
    public function setPayee(int $payee): void 
    {
        $this->payee = $payee;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'value' => $this->getValue(),
            'payer' => $this->getPayer(),
            'payee' => $this->getPayee(),
            'status' => $this->getStatus(),
        ];
    }
}