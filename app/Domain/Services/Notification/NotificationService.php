<?php

namespace App\Domain\Services\Notification;

use App\Domain\Entities\Notification\Notification;
use App\Domain\Entities\Notification\Status\Pending;
use App\Domain\Entities\Notification\Status\Delivered;
use App\Domain\Entities\Notification\Messages\PayeeTransactionSuccessNotification;
use App\Domain\Entities\Notification\Messages\PayerTransactionSuccessNotification;
use App\Domain\Entities\Transaction\Transaction;
use App\Infrastructure\Repositories\Notification\NotificationRepository;

class NotificationService implements INotificationService
{
    private $repository;

    public function __construct(NotificationRepository $repository = new NotificationRepository)
    {
        $this->repository = $repository;
    }

    public function notifyTransactions(Transaction $transaction)
    {
        $this->notify(
            $transaction->getPayer(),
            (new PayerTransactionSuccessNotification)->getValue()
        );
        
        $this->notify(
            $transaction->getPayee(),
            (new PayeeTransactionSuccessNotification)->getValue()
        ); 
    }

    public function notify($id, $message)
    {
        $notification = $this->makeNotification(
            $message,
            (new Pending)->getValue(),
            $id
        );

        $notification = $this->repository->create($notification);

        $this->send($notification);
    }
    
    public function makeNotification($message, $status, $userId)
    {
        return new Notification([
            'message' => $message,
            'status' => $status,
            'userId' => $userId
        ]); 
    }

    public function send($notification)
    {
        // bater no mock
        $this->repository->update(
            $notification->id, 
            (new Delivered)->getValue()
        );
    }
}