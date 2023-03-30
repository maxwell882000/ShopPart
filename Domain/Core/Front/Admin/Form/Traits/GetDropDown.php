<?php

namespace App\Domain\Core\Front\Admin\Form\Traits;

trait GetDropDown
{
    abstract static public function getDropItem(): string;

    static public function getDropDown($initial, array $filterBy, string $class, string $attribute)
    {
        $items = $class::filterBy($filterBy)->get()->map(function ($item) use ($attribute) {
            $class = get_called_class();
            $drop = $class::getDropItem();
            return new $drop($item->id, $item->$attribute);
        })->toArray();

        $init = $initial != "" ? $class::find($initial) : new $class();
        $self = get_called_class();
        return new $self($items, $init->$attribute);
    }
}
