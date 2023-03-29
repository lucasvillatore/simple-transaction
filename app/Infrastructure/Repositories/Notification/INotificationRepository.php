<?php

namespace App\Infrastructure\Repositories\Notification;

use App\Domain\Entities\Notification\Notification;

interface INotificationRepository
{

    public function create(Notification $notification);
    public function update($id, $status);
}