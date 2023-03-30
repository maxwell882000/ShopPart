<?php

namespace App\Domain\Installment\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\DropDown\UserDropDownRelation;

class UserInstallmentDropDownRelation extends UserDropDownRelation
{
    static public function getDropDownSearch($initial, array $filterBy)
    {
        $filterBy['user_credit'] = true;
        return self::getDropDown($initial, $filterBy, User::class, 'phone');
    }
}
