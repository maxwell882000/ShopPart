<?php

namespace App\Domain\User\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAssociatedAttribute;
use App\Domain\User\Entities\PlasticCard;

class PlasticCardDropDownAssociated extends BaseDropDownAssociatedAttribute
{
    const KEY = "plastic_id";

    static public function parentKey(): string
    {
        return 'user_id';
    }

    function setType(): string
    {
        return 'number';
    }

    function setName(): string
    {
        return "Выберите пластиковую карту";
    }

    public static function getDropDownParent($initial, $filterBy)
    {
        return self::getDropDown($initial, $filterBy, PlasticCard::class, "pan");
    }
}
