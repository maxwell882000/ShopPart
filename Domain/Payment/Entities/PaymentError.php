<?php

namespace App\Domain\Payment\Entities;

use App\Domain\Installment\Entities\TakenCreditError;

class PaymentError extends TakenCreditError
{
    protected $table = "payment_errors";

}
