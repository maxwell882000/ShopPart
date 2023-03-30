<?php

namespace App\Domain\Payment\Payable;

use App\Domain\Core\Api\CardService\Interfaces\Payable;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Payment\Entities\Payment;
use Illuminate\Support\Collection;

class PaymentPayable extends Payment implements Payable
{

    public function check(): bool
    {
        return $this->status == PurchaseStatus::ACCEPTED;
    }

    public function amount()
    {
        return $this->price; // include both delivery and price of products
    }

    public function account_id()
    {
        return $this->id;
    }

    public function getTokens(): Collection
    {
        return collect($this->card->plastic->card_token);
    }

    public function setTransaction(int $transaction_id)
    {
        $this->card->transaction_id = $transaction_id;
        $this->card->save();
        $this->save();
    }

    public function getTransaction()
    {
        return $this->card->transaction_id;
    }

    public function finishTransaction(array $confirm): bool
    {
        $this->status = PurchaseStatus::FINISHED;
        $this->save();

        return true;
    }
}
