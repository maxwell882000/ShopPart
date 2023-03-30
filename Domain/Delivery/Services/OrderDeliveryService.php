<?php

namespace App\Domain\Delivery\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Delivery\Entities\OrderDelivery;

class OrderDeliveryService extends BaseService
{
    public function getEntity(): Entity
    {
        return OrderDelivery::new();
    }

    public function create(array $object_data):OrderDelivery
    {
        $object_data = [
            'serviceCode' => $object_data['serviceCode'][0],
            'serviceName' => $object_data['serviceName'][0],
            'price' => $object_data['cost'][0]
        ];
        return parent::create($object_data);
    }
}
