<?php

namespace App\Domain\Shop\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;
use App\Domain\Shop\Entities\Shop;

class ShopDropDownSearch extends BaseDropDownSearchAttribute
{
    public static function newShop(bool $create = true, array $filterBy = [])
    {
        return self::new("name", "названию магазина", $create, $filterBy);
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "shop_id";
    }

    function setName(): string
    {
        return "Выберите Магазин";
    }

    static public function getDropDownSearch($initial, array $filterBy)
    {
        return self::getDropDown($initial, $filterBy, Shop::class, "name");
    }
}
