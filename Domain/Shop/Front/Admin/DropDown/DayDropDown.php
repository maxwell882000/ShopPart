<?php

namespace App\Domain\Shop\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDownAttributeTable;
use App\Domain\Shop\Interfaces\DayInterface;

class DayDropDown extends AbstractDropDownAttributeTable
{

    static public function generate($model, $name = null): string
    {
            return (new self(
            self::generateItems(DayInterface::DB_TO_FRONT_ONLY),
            $model,
            DayInterface::DB_TO_FRONT[$name] ?? null))->generateHtml();
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "day";
    }

    function setName(): string
    {
        return "Выберите день недели";
    }
}
