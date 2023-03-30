<?php

namespace App\Domain\Shop\Api;

use App\Domain\Shop\Entities\Shop;

class ShopProduct extends Shop
{
    public function toArray(): array
    {
        return [
            "logo" => $this->logo->fullPath(),
            "name" => $this->name,
            "slug" => $this->slug,
        ];
    }
}
