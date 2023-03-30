<?php

namespace App\Domain\CreditProduct\Front\Admin\DropDown;

use App\Domain\CreditProduct\Entity\MainCredit;

trait ConnectMainCredit
{

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return "main_credit_id";
    }

    function setName(): string
    {
        return "Выберите вид рассрочки";
    }

    static public function getDropDownSearch($initial, array $filterBy)
    {
        return parent::getDropDown($initial, $filterBy, MainCredit::class, "name_current");
    }
}
