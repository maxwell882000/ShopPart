<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\User\Entities\User;

trait ConnectUserTrait
{

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "user_id";
    }

    function setName(): string
    {
        return "Выберите клиента";
    }

    static public function getDropDownSearch($initial, array $filterBy)
    {
        return self::getDropDown($initial, $filterBy, User::class, 'phone');
    }
}
