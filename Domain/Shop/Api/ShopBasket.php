<?php

namespace App\Domain\Shop\Api;

use App\Domain\Shop\Entities\Shop;

class ShopBasket extends Shop
{
    public function toArray()
    {
        return [
            "name" => $this->name,
            "slug" => $this->slug,
        ];
    }
}
