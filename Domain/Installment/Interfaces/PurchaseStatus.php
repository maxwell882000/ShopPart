<?php

namespace App\Domain\Installment\Interfaces;

use App\Domain\Payment\Interfaces\PaymentStatus;

interface PurchaseStatus extends PaymentStatus
{
    const ANNULLED = 100;
    const REQUIRED_SURETY = 10; // surety not equal to null
    const REQUIRED_SURETY_ADDED = 20;
    const FINISHED = 3;
    const NOT_PAID = -1;
}
