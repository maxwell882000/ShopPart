<?php

namespace App\Domain\CreditProduct\Front\Admin\DropDown;


use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownSearchAttribute;
use App\Domain\CreditProduct\Entity\MainCredit;

class MainCreditDropDownSearch extends BaseDropDownSearchAttribute
{
    use ConnectMainCredit;

    public static function newCredit(
        bool $create = true, array $filterBy = [])
    {
        return self::new("name->" . app()->getLocale(), "названию Рассрочки",
            $create, $filterBy);
    }

}
