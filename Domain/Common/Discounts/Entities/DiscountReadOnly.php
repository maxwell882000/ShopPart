<?php

namespace App\Domain\Common\Discounts\Entities;

use Illuminate\Support\Facades\Request;

class DiscountReadOnly extends Discount
{
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "image" => Request::has("isMobile") && Request::query('isMobile') == "true" ? $this->getMobImageCurrentAttribute()->fullPath()
                : $this->getDesImageCurrentAttribute()->fullPath(),
        ];
    }
}
