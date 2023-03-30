<?php

namespace App\Domain\Core\Main\Builders\Traits;

trait HasProduct
{
    abstract public function joinProduct();

    public function byProducts($ids)
    {
        return $this->joinProduct()->whereIn('products.id', $ids);
    }

    public function byProduct($product_id)
    {
        return $this->joinProduct()->
        where("products.id", '=', $product_id);
    }
}
