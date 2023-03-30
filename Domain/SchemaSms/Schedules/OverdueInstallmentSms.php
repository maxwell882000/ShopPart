<?php

namespace App\Domain\SchemaSms\Schedules;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Jobs\OverdueInstallmentJobs;

class OverdueInstallmentSms extends AbstractSchedule
{

    public function run()
    {
        $taken = TakenCredit::unpaidCredits()->get();
        $this->dispatch($taken, OverdueInstallmentJobs::class);
    }
}
