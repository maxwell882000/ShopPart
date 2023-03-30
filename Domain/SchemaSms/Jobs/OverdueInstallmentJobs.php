<?php

namespace App\Domain\SchemaSms\Jobs;

use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;

class OverdueInstallmentJobs extends BaseSmsJob
{

    function getSms()
    {
        $this->sms = SchemaSmsInstallment::expired()->first();
    }


}
