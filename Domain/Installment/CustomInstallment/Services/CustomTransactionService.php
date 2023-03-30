<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Installment\CustomInstallment\Entities\CustomTransactions;
use App\Domain\Installment\Services\TransactionService;

class CustomTransactionService extends TransactionService
{
    protected function getEntity()
    {
        return CustomTransactions::class;
    }
}
