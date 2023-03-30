<?php

namespace App\Domain\Installment\CustomInstallment\Schedule;

use App\Domain\Installment\CustomInstallment\Jobs\CustomMonthPaidJobs;
use App\Domain\Installment\CustomInstallment\Payable\CustomMonthPaidPayable;
use App\Domain\Installment\Jobs\MonthPaidJobs;
use App\Domain\Installment\Payable\MonthPaidPayable;
use App\Domain\Installment\Schedule\InstallmentDailyCheck;

class CustomInstallmentDailyCheck extends InstallmentDailyCheck
{
    const PAYABLE = CustomMonthPaidPayable::class;
    const JOBS = CustomMonthPaidJobs::class;

}
