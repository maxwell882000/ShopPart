<?php

namespace App\Domain\SchemaSms\Schedules;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Jobs\BeforeInstallmentJobs;

class BeforeInstallmentSms extends AbstractSchedule
{
    const BEFORE_DAYS = 3;

    public function run()
    {
        // pay please for all month paid you did not paid
        $taken = TakenCredit::with("purchase")->allUnpaid()->soonPayment(static::BEFORE_DAYS)->get();
        $this->dispatch($taken, BeforeInstallmentJobs::class);
    }
}
