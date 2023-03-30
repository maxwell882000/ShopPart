<?php

namespace App\Domain\Shop\Front\Admin\DropDown;

use App\Domain\Delivery\Front\Admin\DropDown\AvailableCitiesDropDownSearch;
use App\Domain\Shop\Interfaces\ShopRelationInterface;

class ShopAvailableCitiesDropDownSearch extends AvailableCitiesDropDownSearch implements ShopRelationInterface
{
    public function setKey(): string
    {
        return self::ADDRESS_TO_DELIVERY_TO . parent::setKey();
    }
}
