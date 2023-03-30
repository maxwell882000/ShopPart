<?php

namespace App\Domain\Installment\Services;

use App\Domain\Installment\Entities\MonthPaid;
use App\Domain\Installment\Entities\Transaction;
use App\Domain\Installment\Interfaces\TransactionServiceInterface;
use App\Domain\Installment\Payable\MonthPaidPayable;

class TransactionService implements TransactionServiceInterface
{
    protected function getEntity()
    {
        return Transaction::class;
    }

    public function create(MonthPaidPayable $paid, $new_payment, $type = self::MONTH_PAY, $transaction_id =null)
    {
        $var = $this->getEntity();
        $var::create(
            [
                'month_id' => $paid->id,
                'type' => $type,
                'transaction_id' => $transaction_id ??$paid->getTransaction(),
                "amount" => $new_payment, // only current value is considered
            ]
        );
    }
}
