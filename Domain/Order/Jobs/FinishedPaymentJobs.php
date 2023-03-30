<?php

namespace App\Domain\Order\Jobs;

use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Order\Entities\UserPurchase;

class FinishedPaymentJobs extends AbstractJob
{
    private UserPurchase $purchase;

    public function __construct(UserPurchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function handle()
    {

    }
}
