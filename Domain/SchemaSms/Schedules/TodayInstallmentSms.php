<?php

namespace App\Domain\SchemaSms\Schedules;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Jobs\TodayInstallmentJobs;

class TodayInstallmentSms extends AbstractSchedule
{

    public function run()
    {
        $taken = TakenCredit::allUnpaid()->todayPayment()->get();
        $this->dispatch($taken, TodayInstallmentJobs::class);
    }
}
