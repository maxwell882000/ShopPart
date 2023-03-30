<?php

namespace App\Domain\Common\Brands\Front\Admin\DropDown;

use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;

class BrandDropDownSearch extends BaseDropDownSearchAttribute
{
    public static function newBrand(
        bool $create = true, array $filterBy = [])
    {
        return self::new("brand", "названию Брэнда",
            $create, $filterBy);
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "brand_id";
    }

    function setName(): string
    {
        return __("Выберите Брэнд");
    }

    static public function getDropDownSearch($initial, array $filterBy)
    {
        return self::getDropDown($initial, $filterBy, Brand::class, "brand");
    }
}
