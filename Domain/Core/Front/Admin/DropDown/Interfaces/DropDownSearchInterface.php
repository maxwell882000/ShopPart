<?php

namespace App\Domain\Core\Front\Admin\DropDown\Interfaces;

interface DropDownSearchInterface
{
    static public function getDropDownSearch($initial, array $filterBy);
}
