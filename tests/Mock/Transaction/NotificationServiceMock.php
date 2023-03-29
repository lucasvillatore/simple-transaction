<?php

namespace Tests\Mock\Transaction;

use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Services\Notification\INotificationService;

class NotificationServiceMock implements INotificationService
{
    public function notifyTransactions(Transaction $transaction)
    {
    }

    public function notify($id, $message)
    {

    }
    
    public function makeNotification($message, $status, $userId)
    {

    }

    public function send($notification)
    {
        
    }
}