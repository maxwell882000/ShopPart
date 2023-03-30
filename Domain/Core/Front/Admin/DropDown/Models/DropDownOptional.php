<?php

namespace App\Domain\Core\Front\Admin\DropDown\Models;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractLivewireDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireItem;

class DropDownOptional extends AbstractDropDown
{

    function setType(): string
    {
        return "";
    }

    function setKey(): string
    {
        return "";
    }

    function setName(): string
    {
        return __("Дополнительный действия");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
       return  new self([]);
    }

    static public function formatClick($value)
    {
        // TODO: Implement formatClick() method.
    }
}
