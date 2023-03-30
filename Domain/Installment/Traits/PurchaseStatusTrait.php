<?php

namespace App\Domain\Installment\Traits;

use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Payment\Interfaces\PaymentStatus;
use App\Domain\Payment\Traits\PaymentStatusTrait;

trait PurchaseStatusTrait
{
    use PaymentStatusTrait , HasNotPaid;

    public function isRequiredSurety()
    {
        return ($this->status % 100 - $this->status % 10) == PurchaseStatus::REQUIRED_SURETY;
    }

    public function isAccepted()
    {
        return $this->status % 10 == PaymentStatus::ACCEPTED;
    }

    public function isDeclined()
    {
        return $this->status % 10 == PaymentStatus::DECLINED;
    }

    public function isWaited()
    {
        return $this->status % 10 == PaymentStatus::WAIT_ANSWER;
    }


    public function isFinished()
    {
        return $this->status == PurchaseStatus::FINISHED;
    }
}
