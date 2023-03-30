<?php

namespace App\Domain\Common\Api;

use App\Domain\Common\Colors\Entities\Color;

class ColorInFilter extends Color
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->getColorCurrentAttribute(),
            "hex" => $this->color_hex,
            "num_product" => $this->product()->count()
        ];
    }
}
