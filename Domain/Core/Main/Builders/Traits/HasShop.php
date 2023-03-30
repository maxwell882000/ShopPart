<?php

namespace App\Domain\Core\Main\Builders\Traits;

trait HasShop
{
    public function byShop($shop_id)
    {
        return $this->joinProduct()->where("products.shop_id", "=", $shop_id)->distinct();
    }
}
