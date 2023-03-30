<?php

namespace App\Domain\Installment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Installment\Entities\PennyForMonthPaid;

class PennyService extends BaseService
{

    public function getEntity(): Entity
    {
        return PennyForMonthPaid::new();
    }
}
