<?php

namespace App\Http\Controllers\Api\Main;

use App\Domain\Shop\Api\ShopCard;
use App\Http\Controllers\Api\Base\ApiController;

class ShopController extends ApiController
{

    public function shop()
    {
        return $this->result(ShopCard::all());
    }
}
