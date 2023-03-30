<?php

namespace App\Domain\Installment\CustomInstallment\Jobs;

class CustomPennyJobs extends CustomMonthPaidJobs
{
    protected function unpaidAction()
    {
        $this->time_service::failedAll($this->monthPaid->getTakenCreditId());
    }
}
