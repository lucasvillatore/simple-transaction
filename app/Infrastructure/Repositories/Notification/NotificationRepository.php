<?php

namespace App\Infrastructure\Repositories\Notification;

use App\Domain\Entities\Notification\Notification;
use App\Domain\Models\Notification as NotificationModel;

class NotificationRepository implements INotificationRepository
{

    public function create(Notification $notification)
    {
        $notification = NotificationModel::create([
            'message' => $notification->getMessage(),
            'user_id' => $notification->getUserId(),
            'status' => $notification->getStatus(),
        ]);

        return new Notification([
            "message" => $notification->message,
            "userId" => $notification->user_id,
            "status" => $notification->status,
            "id" => $notification->id
        ]);
    }

    public function update($id, $status)
    {
        $notification = NotificationModel::where('id', $id)
                        ->update([
                            'status' => $status
                        ]);

        return new Notification([
            "message" => $notification->message,
            "userId" => $notification->user_id,
            "status" => $notification->status,
            "id" => $notification->id
        ]);
    }
}