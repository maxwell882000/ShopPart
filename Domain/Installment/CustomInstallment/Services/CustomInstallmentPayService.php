<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Installment\Services\InstallmentPayService;

class CustomInstallmentPayService extends InstallmentPayService
{
    protected function getSumOfPurchases(): int
    {
        return $this->taken->price;
    }
}
