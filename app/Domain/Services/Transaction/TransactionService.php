<?php

namespace App\Domain\Services\Transaction;

use App\Domain\Entities\User\User;
use App\Domain\Entities\User\Types\CommonUser;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Entities\User\Types\ShopkeeperUser;
use App\Domain\Exceptions\Transaction\TransactionValidatorNotImplementedException;
use App\Domain\Services\User\UserService;
use App\Domain\Services\Notification\NotificationService;
use App\Domain\Services\Transaction\Validators\ITransactionValidator;
use App\Domain\Services\Transaction\Validators\ShopkeeperTransactionService;
use App\Domain\Services\Transaction\Validators\UserTransactionService;
use App\Infrastructure\Repositories\Transaction\ITransactionRepository;
use App\Infrastructure\Repositories\Transaction\TransactionRepository;

class TransactionService
{
    private $repository;
    private $userService;
    private $notificationService;

    public function __construct(
        ITransactionRepository $repository, 
        UserService $userService, 
        NotificationService $notificationService
    ){
        $this->repository = $repository;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }

    public function create(Transaction $transaction)
    {
        $user = $this->userService->getUserById($transaction->getPayer());

        $service = $this->getTransactionValidatorService($user);
        $service->validate($transaction, $user);

        $transaction = $this->repository->create($transaction);
        
        $this->notificationService->notifyTransactions($transaction);

        return $transaction;
    }

    public function getTransactionValidatorService(User $user): ITransactionValidator
    {
        if ($user instanceof CommonUser) {
            return new UserTransactionService();
        }

        if ($user instanceof ShopkeeperUser) {
            return new ShopkeeperTransactionService();
        }

        throw new TransactionValidatorNotImplementedException();
    }
}