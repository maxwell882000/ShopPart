<?php

namespace App\Domain\Shop\Api;

use App\Domain\Shop\Entities\Shop;

class ShopView extends Shop
{
    public function getRouteKeyName(): string
    {
        return "slug";
    }

    public function toArray()
    {
        return [
            "image" => $this->image->fullPath(),
            "logo" => $this->logo->fullPath(),
            "address" => $this->shopAddress->delivery->full_address,
            "name" => $this->name,
            "slug" => $this->slug,
        ];
    }
}
