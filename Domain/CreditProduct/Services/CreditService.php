<?php

namespace App\Domain\CreditProduct\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\CreditProduct\Entity\Credit;

class CreditService extends BaseService
{

    public function getEntity(): Entity
    {
        return new Credit();
    }
}
