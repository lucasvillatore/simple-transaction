<?php

namespace App\Domain\Services\Notification;

use App\Domain\Entities\Transaction\Transaction;

interface INotificationService
{
    public function notifyTransactions(Transaction $transaction);

    public function notify($id, $message);
    
    public function makeNotification($message, $status, $userId);

    public function send($notification);
}