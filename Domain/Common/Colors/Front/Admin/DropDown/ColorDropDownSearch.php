<?php

namespace App\Domain\Common\Colors\Front\Admin\DropDown;


use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;
use App\Domain\Product\Product\Interfaces\ProductInterface;

class ColorDropDownSearch extends BaseDropDownSearchAttribute
{
    public static function newColor(
        bool $create = true, array $filterBy = [], $attributes = [])
    {
        return self::new("color", "названию цвета",
            $create, $filterBy, $attributes);
    }


    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "color_id";
    }

    function setName(): string
    {
        return "Выберите цвет";
    }


    static public function getDropDownSearch($initial, array $filterBy, string $prefix = "")
    {
        $object = self::getDropDown($initial, $filterBy, Color::class, "color_current");
        $object->key = $prefix . $object->key;
        return $object;
    }
}
