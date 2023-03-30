<?php

namespace App\Domain\User\Interfaces;

use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Payment\Entities\Payment;
use App\Domain\User\Entities\User;

interface UserNotificationType
{
    const NEW_USER = User::class;
    const NEW_INSTALLMENT = TakenCredit::class;
    const NEW_PAYMENT = Payment::class;
}
