<?php

namespace App\Domain\Payment\Interfaces;

interface PaymentStatus
{
    const WAIT_ANSWER = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;
}
