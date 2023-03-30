<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\BaseDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireAssociatedItem;
use App\Domain\Core\Front\Admin\Form\Traits\GetDropDown;

abstract class BaseDropDownAssociatedAttribute extends BaseDropDown
{
    use GetDropDown;

    const KEY = "";
    const DROP_ITEM = DropLivewireAssociatedItem::class;

    public static function getDropItem(): string
    {
        return self::DROP_ITEM;
    }

    static abstract public function parentKey(): string;

    public function setKey(): string
    {
        return self::KEY;
    }

    abstract public static function getDropDownParent($initial, $filterBy);
}
