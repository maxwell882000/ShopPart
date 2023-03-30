<?php

namespace App\Domain\Category\Front\Admin\DropDown;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;
use App\Domain\Product\Product\Front\Admin\Functions\FromCategory;

class CategoryDropDownSearch extends BaseDropDownSearchAttribute
{
    public static function newCat(
        bool $create = true, array $filterBy = [])
    {
        return self::new("name", "названию Категорий",
            $create, $filterBy);
    }

    public function additionalParamsHtml(): string
    {
        return sprintf("emiting='%s'", FromCategory::FUNCTION_NAME);
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "category_id";
    }

    function setName(): string
    {
        return "Выберите категорию";
    }

    public static function getDropDownSearch($initial, array $filterBy): CategoryDropDownSearch
    {
        static::applyFilter($filterBy);
        return self::getDropDown($initial, $filterBy, Category::class, 'name_current');
    }

    static protected function applyFilter(&$filterBy)
    {
        $filterBy['height'] = 0;
    }


}
