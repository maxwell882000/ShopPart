<?php

namespace App\Domain\Delivery\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;
use App\Domain\Delivery\Entities\AvailableCities;

class AvailableCitiesDropDownSearch extends BaseDropDownSearchAttribute
{

    static public function newCities(bool $create = true, array $filterBy = [])
    {
        return parent::new(
            'cityName',
            "названию городу",
            $create,
            $filterBy
        );
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "city_id";
    }

    function setName(): string
    {
        return "Выберите город";
    }

    static public function getDropDown($initial, array $filterBy, string $class, string $attribute)
    {
        $items = $class::filterBy($filterBy)->paginate(10)->map(function ($item) use ($attribute) {
            $class = get_called_class();
            $drop = $class::getDropItem();
            return new $drop($item->id, $item->$attribute);
        })->toArray();

        $init = $class::find($initial) ?? new $class();
        $self = get_called_class();
        $object = new $self($items, $init->$attribute);
        return $object;
    }

    static public function getDropDownSearch($initial, array $filterBy)
    {
        return self::getDropDown($initial, $filterBy, AvailableCities::class, "fullName");
    }
}
