<?php

namespace Tests\Mock\Notification;

use App\Domain\Entities\Notification\Notification;
use App\Infrastructure\Repositories\Notification\INotificationRepository;

class NotificationRepositoryMock implements INotificationRepository
{
    private $notifications = [];

    public function create(Notification $notification)
    {
        $notification->setId(count($this->notifications) + 1);
        $this->notifications[] = $notification;

        return new Notification($notification->toArray());
    }

    public function update($id, $status)
    {
        $notification = $this->notifications[$id - 1];
        $notification->setStatus($status);

        $this->notifications[$id -1] = $notification;
    }
}