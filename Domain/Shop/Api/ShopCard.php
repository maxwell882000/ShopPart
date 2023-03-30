<?php

namespace App\Domain\Shop\Api;

use App\Domain\Shop\Entities\Shop;

class ShopCard extends Shop
{
    private function takeImage($object, $skip)
    {
        if (isset($object[$skip]))
            return $object[$skip]->productImageHeader->image->fullPath();
        return url("default_image.png");
    }

    public function toArray()
    {
        $object = $this->product()->take(5)->get();
        return [
            "name" => $this->name,
            "slug" => $this->slug,
            "address" => $this->shopAddress->delivery->full_address,
            "logo" => $this->logo->fullPath(),
            "image" => $this->image_in_cart->fullPath(),
            "left_image" => $this->takeImage($object, 0),
            "right_image" => [
                $this->takeImage($object, 1),
                $this->takeImage($object, 2),
                $this->takeImage($object, 3),
                $this->takeImage($object, 4)
            ]
        ];
    }
}
