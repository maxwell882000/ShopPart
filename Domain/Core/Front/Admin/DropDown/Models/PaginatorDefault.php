<?php

namespace App\Domain\Core\Front\Admin\DropDown\Models;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractLivewireDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireItem;

class PaginatorDefault extends AbstractDropDown
{

    function setName(): string
    {
        return __("Выберите размер списка");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        return new self(
            [
                new DropLivewireItem("10", "setPaginate(10)"),
                new DropLivewireItem("20", "setPaginate(20)"),
                new DropLivewireItem("30", "setPaginate(30)"),
                new DropLivewireItem("40", "setPaginate(40)"),
                new DropLivewireItem("50", "setPaginate(50)"),
            ],
            $name
        );
    }

    function setType(): string
    {
        return "";
    }

    function setKey(): string
    {
        return "";
    }

    static public function formatClick($value)
    {
        // TODO: Implement formatClick() method.
    }
}
