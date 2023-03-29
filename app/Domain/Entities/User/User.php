<?php

namespace App\Domain\Entities\User;

class User
{
    private $id;
    /**
     * .
     *
     * @var string
     */
    private $name;

    /**
     * .
     *
     * @var string
     */
    private $taxpayerId;

    /**
     * .
     *
     * @var string
     */
    private $email;

    /**
     * .
     *
     * @var string
     */
    private $password;

    /**
     * .
     *
     * @var string
     */
    private $type;

    /**
     * 
     * @var float
     */
    private $balance;

    public function __construct(array $data)
    {
        $this->setName($data['name']);
        $this->setTaxPayerId($data['taxpayer_id']);
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
        $this->setType($data['type']);
        $this->setBalance($data['balance']);

    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getTaxPayerId(): string {
        return $this->taxpayerId;
    }

    public function setTaxPayerId(string $taxPayerId): void {
        $this->taxpayerId = $taxPayerId;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
    
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }

    public function getBalance(): float {
        return $this->balance;
    }
    public function toArray(): array {
        
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'taxpayer_id' => $this->getTaxPayerId(),
            'type' => $this->getType(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'balance' => $this->getBalance(),
        ];
    }
}