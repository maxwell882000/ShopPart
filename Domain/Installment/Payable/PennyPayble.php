<?php

namespace App\Domain\Installment\Payable;

use App\Domain\Core\Api\CardService\Interfaces\Payable;
use App\Domain\Core\Api\CardService\Traits\HasTransaction;
use App\Domain\Installment\Entities\PennyForMonthPaid;
use App\Domain\Installment\Interfaces\MonthPayableInterface;
use App\Domain\Installment\Interfaces\TransactionServiceInterface;
use App\Domain\Installment\Services\TransactionService;
use Illuminate\Support\Collection;

class PennyPayble extends PennyForMonthPaid implements MonthPayableInterface
{
    use HasTransaction;

    public function check(): bool
    {
        return $this->month_paid->check() && $this->month_paid->paid == 0;
    }

    public function amount()
    {
        return $this->month_paid->takenCredit->penny - $this->paid;
    }

    public function account_id()
    {
        return $this->id;
    }

    public function getTokens(): Collection
    {
        return $this->month_paid->getTokens();
    }

    public function finishTransaction(array $confirm): bool
    {
        $new_payment = $confirm['store_transaction']['amount'];
        $this->paid = $new_payment;
        $this->save();
        $transaction = $this->getTransactionService();
        $transaction->create($this->month_paid, $new_payment, TransactionServiceInterface::MONTH_PENNY, $this->getTransaction());
        return true;
    }

    public function getTakenCreditId()
    {
        return $this->month_paid->taken_credit_id;
    }

    public function getTransactionService()
    {
        return new TransactionService();
    }
}
