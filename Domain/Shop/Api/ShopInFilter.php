<?php

namespace App\Domain\Shop\Api;

use App\Domain\Shop\Entities\Shop;

class ShopInFilter extends Shop
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "num_product" => $this->product()->count()
        ];
    }
}
