<?php

namespace App\Domain\Payment\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireWithoutActionFilterBy;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ELSEstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerColumn;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextLinkAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Routes\Models\LinkGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Delivery\Front\Admin\Attributes\DeliveryInformation;
use App\Domain\Order\Front\UserPurchaseMain\PurchaseMain;
use App\Domain\Order\Front\UserPurchaseMain\PurchaseMainDelivery;
use App\Domain\Order\Interfaces\UserPurchaseStatus;
use App\Domain\Payment\Entities\Payment;
use App\Domain\Payment\Front\Admin\Attributes\DecisionAttribute;
use App\Domain\User\Front\Admin\Path\UserRouteHandler;

class PaymentShow extends Payment implements CreateAttributesInterface
{
    public function getVarTitle()
    {
        return '__("Информация о покупки  #") . $entity->purchase_id';
    }


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            ContainerRow::newClass("w-full  space-x-4 my-2", [
                BoxTitleContainer::newTitle("Информация о клиенте",
                    "", [
                        KeyTextLinkAttribute::newLink(
                            __("Имя клиента"),
                            self::USER_TO_CRUCIAL_DATA . "name",
                            LinkGenerator::new(UserRouteHandler::new())->show("user_id")
                        ),
                        IFstatement::new('$entity->purchase->isCash()'),
                        KeyTextValueAttribute::new(__("Тип оплаты"), __("Наличка")),
                        ELSEstatement::new(),
                        KeyTextAttribute::new(__("Номер карты"), self::PLASTIC_TO . "card_number"),
                        ENDIFstatement::new()
                        //if plastic show plastic , if cash say payment cash
                    ]),
                BoxTitleContainer::newTitle("Информация о покупке",
                    "",
                    [
                        KeyTextAttribute::new(__("Номер Договора"), self::PURCHASE_TO . 'id'),
                        KeyTextAttribute::new(__("Количество покупок"), self::PURCHASE_TO . 'number_purchase'),
                        IFstatement::new('!$entity->purchase->isDelivery()'),
                        KeyTextAttribute::new(__("Сумма общая сумма договора"), "price_show"),
                        ELSEstatement::new(),
                        KeyTextAttribute::new(__("Сумма товаров"), self::PURCHASE_TO . "sumPurchasesShow()"),
                        KeyTextAttribute::new(__("Сумма доставки"), self::PURCHASE_TO . "sumDeliveryShow()"),
                        ENDIFstatement::new()
                        // information about delivery there is has to be
                    ]),
                DeliveryInformation::new()
            ]),
            NestedContainer::new("__(\"Товары\")", [
                IFstatement::new('$entity->purchase->isDelivery()'),
                new FileLivewireWithoutActionFilterBy("TakenCreditEditDelivery", PurchaseMainDelivery::new()),
                ELSEstatement::new(),
                new  FileLivewireWithoutActionFilterBy("TakenCreditEdit", PurchaseMain::new()),
                ENDIFstatement::new()
            ], [
                'class' => "flex flex-col"
            ]),
            Container::newClass("mt-2", [
                DecisionAttribute::new(),
            ])
        ]);
    }
}
