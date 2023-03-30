<?php

namespace App\Domain\Installment\CustomInstallment\Payable;

use App\Domain\Core\Api\CardService\Interfaces\Payable;
use App\Domain\Core\Api\CardService\Traits\HasTransaction;
use App\Domain\Core\UuidKey\Traits\HasUniqueId;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\Traits\TakenPayableTrait;
use Illuminate\Support\Collection;

class CustomInstallmentPayable extends CustomInstallment implements Payable
{
    use TakenPayableTrait, HasUniqueId;

    // the primary id is incrementing, but contract_num is not, which is not primary attribute
    public function isIncrementing(): bool
    {
        return true;
    }

    public function getPrimary(): string
    {
        return "contract_num";
    }
}
