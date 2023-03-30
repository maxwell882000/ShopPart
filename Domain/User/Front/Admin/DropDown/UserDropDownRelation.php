<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownRelationAttribute;
use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;

class UserDropDownRelation extends BaseDropDownRelationAttribute
{
    use ConnectUserTrait;

    public static function newUser(string $dropDownAssociateClass, string $dispatch = Dispatch::class, bool $create = true, array $filterBy = [])
    {
        return self::newRelation("phone", "номеру пользователя",
            $dropDownAssociateClass, $dispatch, $create, $filterBy);
    }

}
