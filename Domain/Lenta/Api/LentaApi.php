<?php

namespace App\Domain\Lenta\Api;

use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Product\Api\ProductCard;

class LentaApi extends Lenta
{
    const PRODUCT_CLASS = ProductCard::class;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'text' => $this->getTextCurrentAttribute(),
            'products' => $this->product->toArray(),
            "is_left" => $this->is_left,
            "image" => $this->getLeftImageCurrentAttribute()->fullPath()
        ];
    }
}
