<?php

namespace App\Domain\Core\Api\CardService\Traits;
use Illuminate\Support\Facades\Log;
trait HasTransaction
{
    public function setTransaction(int $transaction_id)
    {
        Log::info($transaction_id);
        Log::info("this is transactiion !!!!!");
        $this->transaction_id = $transaction_id;
        $this->save();
    }

    public function getTransaction(): ?int
    {
        return $this->transaction_id;
    }
}
