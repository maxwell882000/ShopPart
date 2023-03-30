<?php

namespace App\Domain\Installment\Jobs;

class PennyPaidJobs extends MonthPaidJobs
{
    // here we will just say , that we couldn't withdraw money
    protected function unpaidAction()
    {
        $this->time_service::failedAll($this->monthPaid->getTakenCreditId());
    }
}
