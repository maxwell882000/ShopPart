<?php

namespace App\Domain\Shop\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Shop\Entities\WorkTimes;

class WorkTimesService extends BaseService
{

    public function getEntity(): Entity
    {
        return new WorkTimes();
    }
}
