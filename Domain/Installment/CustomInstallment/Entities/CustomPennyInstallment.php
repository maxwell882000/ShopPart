<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Installment\CustomInstallment\Builders\CustomPennyInstallmentBuilder;
use App\Domain\Installment\CustomInstallment\Services\CustomTransactionService;
use App\Domain\Installment\Entities\PennyForMonthPaid;
use App\Domain\Installment\Payable\PennyPayble;
use App\Domain\Installment\Services\TransactionService;

class CustomPennyInstallment extends PennyPayble
{
    protected $table = "custom_penny_installment";
    const  BUILDER = CustomPennyInstallmentBuilder::class;
    const  MONTH_PAID = CustomMonthPaid::class;

    public function getTransactionService(): TransactionService
    {
        return new CustomTransactionService();
    }
}
