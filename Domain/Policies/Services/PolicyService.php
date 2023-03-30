<?php

namespace App\Domain\Policies\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Policies\Entity\Policy;

class PolicyService extends BaseService
{

    public function getEntity(): Entity
    {
        return Policy::new();
    }
}
