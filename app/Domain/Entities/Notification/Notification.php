<?php

namespace App\Domain\Entities\Notification;

class Notification
{
    private $id;

    private $message;

    private $status;

    private $userId;

    public function __construct(array $data)
    {
        $this->setId($data['id'] ?? null);
        $this->setMessage($data['message']);
        $this->setStatus($data['status']);
        $this->setUserId($data['userId']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function toArray()
    {
        return [
            'message' => $this->getMessage(),
            'status' => $this->getStatus(),
            'userId' => $this->getUserId(),
            'id' => $this->getId()
        ];
    }
}
