<?php

namespace App\Domain\Installment\Front\Main;

use App\Domain\Core\Front\Admin\Attributes\Conditions\ELSEstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Attributes\Models\EmptyAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Js\Interfaces\FilterJsInterface;
use App\Domain\Installment\Front\Admin\Attributes\DecisionAttribute;

class TakenCreditEdit extends TakenCreditShow implements FilterJsInterface
{
    public function additionalView()
    {
        return Container::new([], [
            IFstatement::new('!$entity->surety_id'),
            NestedContainer::new("__(\"Добавить поручателя\")", [
                self::generationSuretyCreate(self::SURETY_TO)
            ]),
            ELSEstatement::new(),
            NestedContainer::new("__(\"Изменить поручателя\")", [
                self::generationSuretyEdit(self::SURETY_TO, TakenCreditEdit::class)
            ]),
            ENDIFstatement::new(),
            Container::newClass("mb-4", [
            ]),
            DecisionAttribute::new(),
        ]);
    }

    public function penny()
    {
        return InputAttribute::createAttribute("penny",
            "text",
            "Пенни", '', "", self::ONLY_NUMBER);
    }

    protected static function getPlastic($className = 'SuretyOpenEdit')
    {
        return EmptyAttribute::new();
    }
}
