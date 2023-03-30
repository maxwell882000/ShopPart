<?php

namespace App\Domain\Delivery\Front\Admin\Attributes;

use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Models\EmptyAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Installment\Interfaces\PurchaseRelationInterface;

class DeliveryInformation extends EmptyAttribute implements PurchaseRelationInterface
{
    use AttributeGetVariable;

    // количество посылок
// сколько посылок доставлено
// сколько посылок в пути
// общая цена за доставку
// Город доставки
// Адрес доставки
    public function generateHtml(): string
    {
        return Container::new([], [
            IFstatement::new('$entity->purchase->isDelivery()'),
            BoxTitleContainer::newTitle("Информация о доставке",
                "", [


                    KeyTextValueAttribute::new(self::lang("Индекс"),
                        self::getAttributeVariable(self::DELIVERY_ADDRESS_TO . 'index')),
                    KeyTextAttribute::new(self::lang("Область"),
                        self::AVAILABLE_CITIES_TO . 'regionNameCurrent'),
                    KeyTextAttribute::new(self::lang("Город доставки"),
                        self::AVAILABLE_CITIES_TO . 'cityNameCurrent'),
                    KeyTextValueAttribute::new(self::lang("Адрес доставки"),
                        self::getAttributeVariable(self::DELIVERY_ADDRESS_TO . 'street')
                        . ', ' .
                        self::getAttributeVariable(self::DELIVERY_ADDRESS_TO . 'house'),
                    ),
                    KeyTextValueAttribute::new(self::lang("Специальные указания для курьера"),
                        self::getAttributeVariable(self::DELIVERY_ADDRESS_TO . 'instructions')),

                    IFstatement::new(self::getWithoutScopeAtrVariable(self::DELIVERY_TO . "exists()")),
                    KeyTextAttribute::new(self::lang("Количество посылок"),
                        self::PURCHASE_TO . "deliveryCount()"),
                    KeyTextAttribute::new("Количество посылок доставлено",
                        self::PURCHASE_TO . "deliveredCount()"),
                    ENDIFstatement::new(),
                    KeyTextValueAttribute::new(__("Общая цена за доставку"),
                        self::getAttributeVariable(self::PURCHASE_TO . "sumDeliveryShow()") . " сум"),

                ]),
            ENDIFstatement::new()

        ])->generateHtml();
    }
}
