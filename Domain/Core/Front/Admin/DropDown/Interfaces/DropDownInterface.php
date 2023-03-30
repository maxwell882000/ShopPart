<?php

namespace App\Domain\Core\Front\Admin\DropDown\Interfaces;

interface DropDownInterface
{
    function setType():string;

    function setKey():string;

    function setName():string;
}
