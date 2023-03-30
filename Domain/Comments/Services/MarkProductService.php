<?php

namespace App\Domain\Comments\Services;

use App\Domain\Comments\Entities\MarkProduct;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class MarkProductService extends BaseService
{

    public function getEntity(): Entity
    {
        return MarkProduct::new();
    }
}
