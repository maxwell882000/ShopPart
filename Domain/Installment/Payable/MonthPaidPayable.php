<?php

namespace App\Domain\Installment\Payable;

use App\Domain\Core\Api\CardService\Traits\HasTransaction;
use App\Domain\Installment\Entities\MonthPaid;
use App\Domain\Installment\Interfaces\MonthPayableInterface;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Installment\Interfaces\TransactionServiceInterface;
use App\Domain\Installment\Services\TransactionService;
use Illuminate\Support\Collection;

class   MonthPaidPayable extends MonthPaid implements MonthPayableInterface
{
    use HasTransaction;

    public function amount()
    {
        return $this->must_pay - $this->paid;
    }

    public function account_id()
    {
        return $this->id;
    }

    public function getTokens(): Collection
    {
        return $this->takenCredit->getPlasticTokens();
    }


    public function finishTransaction(array $confirm): bool
    {
        $last = $this->takenCredit->monthPaid()->orderBy("month", "DESC")->first();
        $current = $this->takenCredit->monthPaid()->whereMonth('month', '=', now())->first();
        if ($last->id == $this->id) { // weak condition
            $this->takenCredit->status = PurchaseStatus::FINISHED;
        } else if ($current && $current->id == $this->id) {
            $this->takenCredit->status = PurchaseStatus::ACCEPTED;
            // set to NOT PAID if during the month the user do not make the payment
            // so when it successfully pays for the month we can return its status to ACCEPTED
        }
        // I paid everything that was before and plus that I paid know
        $new_payment = $confirm['store_transaction']['amount'];
        $this->paid = $this->paid + $new_payment;
        $this->save();
        $this->takenCredit->save();
        $this->createTransaction($new_payment);
        return true;
    }

    protected function createTransaction($new_payment, $type = TransactionServiceInterface::MONTH_PAY)
    {
        $transaction = $this->getTransactionService();
        $transaction->create($this, $new_payment, $type);
    }

    public function getTransactionService(): TransactionService
    {
        return new TransactionService();
    }

    public function taken_id()
    {
        return $this->taken_credit_id;
    }

    public function check(): bool
    {
        return abs($this->takenCredit->status) == PurchaseStatus::ACCEPTED;
    }

    public function getTakenCreditId()
    {
        return $this->taken_credit_id;
    }
}
