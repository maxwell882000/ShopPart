<?php

namespace App\Domain\Delivery\Schedule;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Delivery\Api\Models\DpdGeography;
use App\Domain\Delivery\Services\AvailableCitiesService;

class AvailableCitiesSchedule extends AbstractSchedule
{
    public function call()
    {
        return parent::call()->mondays();
    }

    public function run()
    {
        $client = new DpdGeography();
        $cities = $client->getSerializedCities("UZ");
        $service = new AvailableCitiesService();
        $service->bulkInsertion($cities);
    }
}
