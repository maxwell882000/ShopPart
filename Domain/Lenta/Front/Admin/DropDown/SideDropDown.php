<?php

namespace App\Domain\Lenta\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\Lenta\Interfaces\SideInterface;

class SideDropDown extends BaseDropDownAttribute
{

    function setType(): string
    {
        return 'number';
    }

    function setKey(): string
    {
        return "is_left";
    }

    function setName(): string
    {
        return __("Выберите сторону картинки");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        return new self([
            new DropItem(SideInterface::LEFT, SideInterface::LEFT_FRONT),
            new DropItem(SideInterface::RIGHT, SideInterface::RIGHT_FRONT)
        ], SideInterface::DB_TO_FRONT[$name] ?? null);
    }
}

{

}
