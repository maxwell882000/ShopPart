<?php

namespace App\Domain\Product\ProductKey\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\ProductKey\Entities\ProductValue;

class ProductValueService extends BaseService
{

    public function getEntity(): Entity
    {
        return new ProductValue();
    }

}
