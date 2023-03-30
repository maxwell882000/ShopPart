<?php

namespace App\Domain\CreditProduct\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownRelationAttribute;
use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;

class MainCreditDropDownRelation extends BaseDropDownRelationAttribute
{
    use ConnectMainCredit;

    public static function newCredit(string $dropDownAssociateClass, string $dispatch = Dispatch::class,
                                     bool   $create = true, array $filterBy = [])
    {
        return self::dynamicSearchRelation("\"name->\" . app()->getLocale()", "названию Рассрочки",
            $dropDownAssociateClass, $dispatch, $create, $filterBy);
    }

}
