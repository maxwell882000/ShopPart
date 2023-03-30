<?php

namespace App\Domain\Installment\CustomInstallment\Front\Nested;

use App\Domain\Installment\CustomInstallment\Builders\CustomTransactionBuilder;
use App\Domain\Installment\CustomInstallment\Entities\CustomMonthPaid;
use App\Domain\Installment\Front\Nested\TransactionIndex;

class CustomTransactionIndex extends TransactionIndex
{
    protected $table = "custom_transactions";
    public const MONTH_PAID = CustomMonthPaid::class;
    public const BUILDER = CustomTransactionBuilder::class;
}
