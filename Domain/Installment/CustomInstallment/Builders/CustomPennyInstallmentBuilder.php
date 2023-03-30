<?php

namespace App\Domain\Installment\CustomInstallment\Builders;

use App\Domain\Installment\Builders\PennyForMonthPaidBuilder;

class CustomPennyInstallmentBuilder extends PennyForMonthPaidBuilder
{
    protected function installmentTable()
    {
        return "custom_installment";
    }

    protected function monthTable()
    {
        return "custom_month_paid";
    }

    protected function ownTable()
    {
        return "custom_penny_installment";
    }
}
