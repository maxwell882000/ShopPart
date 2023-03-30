<?php

namespace App\Domain\Core\Front\Admin\DropDown\Interfaces;


use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;

interface DropDownMainInterface
{
    static public function getDropDown($name = null): AbstractDropDown;
}
