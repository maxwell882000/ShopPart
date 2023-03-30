<?php

namespace App\Domain\Product\Color\Api;

use App\Domain\Product\Color\Entities\ProductManyColor;

class ProductManyColorApi extends ProductManyColor
{
    public function toArray()
    {
        return $this->image->fullPath();
    }
}
