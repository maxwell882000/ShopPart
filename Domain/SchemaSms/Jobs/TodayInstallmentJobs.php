<?php

namespace App\Domain\SchemaSms\Jobs;

use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;

class TodayInstallmentJobs extends BaseSmsJob
{
    function getSms()
    {
        $this->sms = SchemaSmsInstallment::dayOfPayment()->first();
    }
}
