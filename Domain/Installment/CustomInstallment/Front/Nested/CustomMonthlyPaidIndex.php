<?php

namespace App\Domain\Installment\CustomInstallment\Front\Nested;

use App\Domain\Installment\CustomInstallment\Builders\CustomMonthPaidBuilder;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Admin\Attributes\CustomDescriptionAboutTransaction;
use App\Domain\Installment\CustomInstallment\Front\Admin\Functions\CustomSendSmsNotPaid;
use App\Domain\Installment\Front\Nested\MonthlyPaidIndex;

class CustomMonthlyPaidIndex extends MonthlyPaidIndex
{
    protected $table = "custom_month_paid";
    const BUILDER = CustomMonthPaidBuilder::class;
    const INSTALLMENT = CustomInstallment::class;

    protected function getSmsFunction()
    {
        return CustomSendSmsNotPaid::new();
    }

    protected function getDescriptionAboutTrans()
    {
        return new CustomDescriptionAboutTransaction($this);
    }
}
