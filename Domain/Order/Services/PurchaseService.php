<?php

namespace App\Domain\Order\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Order\Entities\Purchase;

class PurchaseService extends BaseService
{

    public function getEntity(): Entity
    {
        return new Purchase();
    }
}
