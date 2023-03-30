<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;

class UserDropDownSearch extends BaseDropDownSearchAttribute
{
    use ConnectUserTrait;

    public static function newUser(bool $create = true, array $filterBy = [])
    {
        return self::new("phone", "номеру пользователя", $create, $filterBy);
    }

    static public function getDropItem(): string
    {
        return self::DROP_ITEM;
    }
}
