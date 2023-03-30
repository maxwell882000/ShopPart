<?php

namespace App\Domain\Delivery\Api\Test;

use App\Domain\Delivery\Api\Base\DpdClient;
use App\Domain\Delivery\Api\Models\DpdCalculator;
use App\Domain\Delivery\Entities\DeliveryAddress;

class DpdTest
{
    static public function run()
    {

        $client = new DpdCalculator();
//        $client->getCost();
    }
}
