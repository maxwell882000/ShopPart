<?php

namespace App\Domain\Installment\CustomInstallment\Payable;

use App\Domain\Installment\CustomInstallment\Builders\CustomMonthPaidBuilder;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Services\CustomTransactionService;
use App\Domain\Installment\Payable\MonthPaidPayable;
use App\Domain\Installment\Services\TransactionService;

class CustomMonthPaidPayable extends MonthPaidPayable
{
    protected $table = "custom_month_paid";
    const BUILDER = CustomMonthPaidBuilder::class;
    const INSTALLMENT = CustomInstallment::class;

    public function getTransactionService(): TransactionService
    {
        return new CustomTransactionService();
    }
}
