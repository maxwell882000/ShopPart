<?php

namespace App\Domain\Installment\CustomInstallment\Schedule;

use App\Domain\Installment\CustomInstallment\Entities\CustomPennyInstallment;
use App\Domain\Installment\CustomInstallment\Jobs\CustomPennyJobs;
use App\Domain\Installment\Schedule\InstallmentCheckForPenny;

class CustomInstallmentPennyCheck extends InstallmentCheckForPenny
{
    const PAYABLE = CustomPennyInstallment::class;
    const JOBS = CustomPennyJobs::class;
}
