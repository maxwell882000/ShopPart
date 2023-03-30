<?php

namespace App\Domain\Installment\Payable;

use App\Domain\Installment\Interfaces\TransactionServiceInterface;

class MonthPaidClientPayable extends MonthPaidPayable
{
    protected function createTransaction($new_payment, $type = TransactionServiceInterface::MONTH_PAY_CLIENT)
    {
        parent::createTransaction($new_payment, $type);
    }
}
