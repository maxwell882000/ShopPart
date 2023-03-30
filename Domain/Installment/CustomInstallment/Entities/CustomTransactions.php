<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Installment\CustomInstallment\Builders\CustomTransactionBuilder;
use App\Domain\Installment\Entities\Transaction;

class CustomTransactions extends Transaction
{
    protected $table = "custom_transactions";
    public const MONTH_PAID = CustomMonthPaid::class;
    public const BUILDER =  CustomTransactionBuilder::class;
}
