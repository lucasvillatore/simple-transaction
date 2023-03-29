<?php

namespace App\Infrastructure\Repositories\Transaction;

use App\Domain\Models\User as UserModel;
use App\Domain\Models\Transaction as TransactionModel;
use App\Domain\Entities\Transaction\Transaction;
use App\Domain\Services\Transaction\Validators\ExternalAuthorizerService;
use App\Domain\Entities\Transaction\Status\InProgress;
use App\Domain\Entities\Transaction\Status\Completed;
use App\Domain\Entities\Transaction\Status\Failed;
use App\Domain\Exceptions\Transaction\ExternalAuthorizerDeniedException;

use Illuminate\Support\Facades\DB;
use Exception;

class TransactionRepository implements ITransactionRepository
{
    private $authorizerService;

    public function __construct(ExternalAuthorizerService $authorizerService = new ExternalAuthorizerService())
    {
        $this->authorizerService = $authorizerService;
    }

    private function authorize()
    {
        if (!$this->authorizerService->verifyExternalAuthorizer()) {
            throw new ExternalAuthorizerDeniedException();
        }
    }

    public function create(Transaction $transaction)
    {

        $transaction->setStatus((new InProgress)->getValue());
        $transaction = TransactionModel::create([
            'payer_id' => $transaction->getPayer(),
            'payee_id' => $transaction->getPayee(),
            'status' => $transaction->getStatus(),
            'value' => $transaction->getValue()
        ]);

        try {
            DB::beginTransaction();

            $payer = UserModel::find($transaction->payer_id);
            $payee = UserModel::find($transaction->payee_id);

            $this->authorize();

            $payer->balance = $payer->balance - $transaction->value;
            $payer->save();

            $payee->balance = $payee->balance + $transaction->value;
            $payee->save();

            $transaction->status = (new Completed)->getValue();
            $transaction->save();

            DB::commit();
        }
        catch(Exception $e){
            DB::rollBack();
            $transaction->status = (new Failed)->getValue();
            $transaction->save();


            throw new $e;
        }

        
        return (new Transaction($transaction->toArray()));
    }
}