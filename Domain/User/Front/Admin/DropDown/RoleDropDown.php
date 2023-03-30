<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\User\Interfaces\Roles;
use App\Domain\User\Interfaces\UserRelationInterface;

class RoleDropDown extends BaseDropDownAttribute
{

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return UserRelationInterface::ROLE_TO . "role";
    }

    function setName(): string
    {
        return __("Выберите роль");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        return new self([
            new DropItem(Roles::ADMIN_MAIN, __(Roles::DB_TO_FRONT[Roles::ADMIN_MAIN])),
            new DropItem(Roles::ADMIN_MODERATOR, __(Roles::DB_TO_FRONT[Roles::ADMIN_MODERATOR])),
            new DropItem(Roles::NOT_ADMIN, __(Roles::DB_TO_FRONT[Roles::NOT_ADMIN])),
        ], Roles::DB_TO_FRONT[$name] ?? null);
    }
}
