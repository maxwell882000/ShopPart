<?php

namespace App\Domain\Installment\CustomInstallment\Jobs;

use App\Domain\Installment\CustomInstallment\Services\CustomTimeScheduleService;
use App\Domain\Installment\Jobs\FailedToWithdraw;

class CustomFailedToWithdraw extends FailedToWithdraw
{
    protected function getService(): string
    {
        return CustomTimeScheduleService::class;
    }
}
