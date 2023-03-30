<?php

namespace App\Domain\SchemaSms\Jobs;

use App\Domain\SchemaSms\Traits\HasRemainderSms;

class BeforeInstallmentJobs extends BaseSmsJob
{
    use HasRemainderSms;
}
