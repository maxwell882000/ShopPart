<?php

namespace App\Domain\Delivery\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Delivery\Entities\Delivery;

class DeliveryService extends BaseService
{

    public function getEntity(): Entity
    {
        return new Delivery();
    }
}
