<?php

namespace App\Domain\Payment\Traits;

use App\Domain\Payment\Interfaces\PaymentStatus;

trait PaymentStatusTrait
{
    public function isWaited()
    {
        return $this->status == PaymentStatus::WAIT_ANSWER;
    }

    public function isAccepted()
    {
        return $this->status = PaymentStatus::ACCEPTED;
    }

    public function isDeclined()
    {
        return $this->status = PaymentStatus::DECLINED;
    }

}
