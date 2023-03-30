<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Installment\CustomInstallment\Builders\CustomMonthPaidBuilder;
use App\Domain\Installment\Entities\MonthPaid;

class CustomMonthPaid extends MonthPaid
{
    protected $table = "custom_month_paid";
    const BUILDER = CustomMonthPaidBuilder::class;
    const INSTALLMENT = CustomInstallment::class;
}
