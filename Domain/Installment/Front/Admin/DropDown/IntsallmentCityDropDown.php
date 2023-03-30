<?php

namespace App\Domain\Installment\Front\Admin\DropDown;

use App\Domain\Installment\Interfaces\PurchaseRelationInterface;
use App\Domain\Shop\Front\Admin\DropDown\ShopAvailableCitiesDropDownSearch;

class IntsallmentCityDropDown extends ShopAvailableCitiesDropDownSearch
{
    public function setKey(): string
    {
        return PurchaseRelationInterface::DELIVERY_ADDRESS_TO . "city_id";
    }
}
