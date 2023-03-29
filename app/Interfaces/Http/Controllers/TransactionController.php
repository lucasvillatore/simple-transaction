<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Services\Transaction\TransactionService;
use App\Interfaces\Http\Requests\TransactionCreateRequest;
class TransactionController extends Controller
{

    private $transactionService;

    public function __construct (TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function create(TransactionCreateRequest $request)
    {
        $transaction = $this->transactionService->create(
            new Transaction($request->toArray())
        );

        return response()->json($transaction, 201);
    }
}