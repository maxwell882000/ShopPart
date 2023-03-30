<?php

namespace App\Domain\Product\Product\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\Product\Product\Interfaces\ProductInterface;

class CurrencyDropDown extends BaseDropDownAttribute
{

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "currency";
    }

    function setName(): string
    {
        return __("Выберите валюту");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        return new self([
            new DropItem(ProductInterface::CURRENCY_USD_DB, ProductInterface::CURRENCY_USD_TEXT),
            new DropItem(ProductInterface::CURRENCY_UZS_DB, ProductInterface::CURRENCY_UZS_TEXT)
        ], ProductInterface::DB_TO_TEXT[$name] ?? null);
    }


}
