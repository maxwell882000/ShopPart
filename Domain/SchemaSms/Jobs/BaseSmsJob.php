<?php

namespace App\Domain\SchemaSms\Jobs;

use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Interfaces\SchemaSmsStatus;
use App\Domain\SchemaSms\Traits\HasSendSms;

abstract class BaseSmsJob extends AbstractJob implements SchemaSmsStatus
{
    use  HasSendSms;

    protected $taken_credit;

    public function __construct(TakenCredit $credit)
    {
        $this->taken_credit = $credit;
    }

    public function handle()
    {
        $this->init();
    }

    function phone()
    {
        return $this->taken_credit->plastic->phone;
    }
}
