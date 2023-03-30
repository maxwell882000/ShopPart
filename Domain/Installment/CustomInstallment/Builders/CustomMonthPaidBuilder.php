<?php

namespace App\Domain\Installment\CustomInstallment\Builders;

use App\Domain\Installment\Builders\MonthPaidBuilder;

class CustomMonthPaidBuilder extends MonthPaidBuilder
{
    protected function ownTable()
    {
        return "custom_month_paid";
    }

    protected function parentTable(): string
    {
        return "custom_installment";
    }
}
