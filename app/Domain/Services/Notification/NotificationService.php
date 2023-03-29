<?php

namespace App\Domain\Services\Notification;

use App\Domain\Entities\Notification\Notification;
use App\Domain\Entities\Notification\Status\Pending;
use App\Domain\Entities\Notification\Status\Delivered;
use App\Domain\Entities\Notification\Messages\PayeeTransactionSuccessNotification;
use App\Domain\Entities\Notification\Messages\PayerTransactionSuccessNotification;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Exceptions\Notification\FailedToSendNotificationException;
use App\Infrastructure\Repositories\Notification\INotificationRepository;
use App\Infrastructure\Repositories\Notification\NotificationRepository;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    private $repository;
    private $url;

    public function __construct(INotificationRepository $repository = new NotificationRepository, $url)
    {
        $this->repository = $repository;
        $this->url = $url;
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
        $response = Http::timeout(10)
                    ->post($this->url);

        if (!$response->successful()) {
            throw new FailedToSendNotificationException();
        }
        $this->repository->update(
            $notification->getId(), 
            (new Delivered)->getValue()
        );
    }
}