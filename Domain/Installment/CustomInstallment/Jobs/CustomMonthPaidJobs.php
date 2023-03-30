<?php

namespace App\Domain\Installment\CustomInstallment\Jobs;

use App\Domain\Installment\CustomInstallment\Services\CustomTimeScheduleService;
use App\Domain\Installment\Jobs\MonthPaidJobs;

class CustomMonthPaidJobs extends MonthPaidJobs
{
    protected function failedClass(): string
    {
        return CustomFailedToWithdraw::class;
    }

    protected function timeService(): string
    {
        return CustomTimeScheduleService::class;
    }
}
