<?php

namespace App\Domain\Installment\Payable;

use App\Domain\Core\Api\CardService\Interfaces\Payable;
use App\Domain\Core\Api\CardService\Traits\HasTransaction;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Traits\TakenPayableTrait;
use Illuminate\Support\Collection;

class TakenCreditPayable extends TakenCredit implements Payable
{
    use TakenPayableTrait;
}
