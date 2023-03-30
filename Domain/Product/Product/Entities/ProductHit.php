<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\CheckedAttribute;

class ProductHit extends Entity
{
    use CheckedAttribute;

    protected $table = "product_hits";

}
