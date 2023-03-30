<?php

namespace App\Domain\CreditProduct\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAssociatedAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownRelationAttribute;
use App\Domain\CreditProduct\Entity\Credit;

class CreditDropDownAssociated extends BaseDropDownAssociatedAttribute
{

    const  KEY = "credit_id";

    function setType(): string
    {
        return "number";
    }

    function setName(): string
    {
        return "Выберите месяц";
    }

    static public function parentKey(): string
    {
        return 'main_credit_id';
    }

    public static function getDropDownParent($initial, $filterBy)
    {
        return self::getDropDown($initial, $filterBy, Credit::class, "month");
    }
}
