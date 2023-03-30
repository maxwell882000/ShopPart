<?php

namespace App\Domain\Product\Product\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Product\Entities\ProductInfo;

class ProductInfoService extends BaseService
{
    public function getEntity(): Entity
    {
        return ProductInfo::new();
    }
}
