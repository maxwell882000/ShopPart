<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\User\Interfaces\SexInterface;
use App\Domain\User\Interfaces\UserRelationInterface;

class SexDropDown extends BaseDropDownAttribute
{

    function setType(): string
    {
        return 'number';
    }

    function setKey(): string
    {
        return UserRelationInterface::USER_DATA . "sex";
    }

    function setName(): string
    {
        return __("Выберите пол");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        return new self([
            new DropItem(SexInterface::MAN, SexInterface::MAN_FRONT),
            new DropItem(SexInterface::WOMEN, SexInterface::WOMEN_FRONT)
        ], SexInterface::DB_TO_FRONT[$name] ?? null);
    }
}
