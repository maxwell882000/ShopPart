<?php

namespace App\Domain\Order\Traits;

use App\Domain\Order\Interfaces\UserPurchaseRelation;

trait UserPurchaseStatus
{

    protected function getPayment(): int
    {
        return $this->status % 1000 - $this->status % 100;
    }

    public function isInstallment(): bool
    {
        return $this->getPayment() == self::INSTALMENT - 1;
    }

    public function isInstansPayment(): bool
    {
        return $this->getPayment() == self::INSTANCE_PAYMENT;
    }

    public function isCash(): bool
    {
        return $this->status % 10 == self::CASH && !$this->isInstallment();
    }

    public function isCard(): bool
    {
        return $this->status % 10 == self::CARD || $this->isInstallment();
    }

    public function isDelivery(): bool
    {
        $status = $this->status % 100;
        $rest = $this->status % 10;
        $delivery = $status - $rest;
        return $delivery == UserPurchaseRelation::DELIVERY;
    }
}
