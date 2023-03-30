<?php

namespace App\Domain\Delivery\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Delivery\Entities\DeliveryAddress;

class DeliveryAddressService extends BaseService
{

    public function getEntity(): Entity
    {
        return DeliveryAddress::new();
    }
}
