<?php

namespace App\Domain\Installment\CustomInstallment\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireWithoutActionFilterBy;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerColumn;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextLinkAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextLinkDownloadAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Routes\Models\LinkGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Delivery\Front\Admin\Attributes\DeliveryInformation;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Admin\Nested\CustomTimeScheduleIndex;
use App\Domain\Installment\CustomInstallment\Front\Dynamic\CustomCommentDynamic;
use App\Domain\Installment\CustomInstallment\Front\Dynamic\CustomPlasticCardDynamic;
use App\Domain\Installment\CustomInstallment\Front\Nested\CustomMonthlyPaidIndex;
use App\Domain\Installment\Front\Admin\Attributes\ConditionAttribute;
use App\Domain\Installment\Front\Admin\Attributes\DecisionAttribute;
use App\Domain\Installment\Front\Dynamic\CommentInstallmentDynamic;
use App\Domain\Installment\Front\Dynamic\PlasticCardTakenCreditDynamic;
use App\Domain\Installment\Front\Nested\MonthlyPaidIndex;
use App\Domain\Installment\Front\Nested\TimeScheduleTransactionIndex;
use App\Domain\Installment\Front\Traits\HasPenny;
use App\Domain\Order\Front\UserPurchaseMain\PurchaseMain;
use App\Domain\User\Front\Admin\Path\UserRouteHandler;

class CustomInstallmentShow extends CustomInstallment implements CreateAttributesInterface
{
    use AttributeGetVariable;

    public function getVarTitle()
    {
        return '__("Информация о ручной рассрочке  #") . $entity->contract_num';
    }


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            Container::newClass("space-y-4 mr-4", [
                ContainerRow::newClass("w-full", [
                    ContainerColumn::newClass("basis-5/12", [
                        BoxTitleContainer::newTitle("Информация о клиенте",
                            "", [
                                KeyTextAttribute::new(
                                    __("Имя клиента"), "name",
                                ),
                                KeyTextAttribute::new(__("Номер телефона"), self::PLASTIC_CARD_TO . "phone"),
                                KeyTextAttribute::new(__("Номер карты"), self::PLASTIC_CARD_TO . "card_number"),

                            ]),
                        BoxTitleContainer::newTitle("Информация о кредите",
                            "",
                            [
                                KeyTextAttribute::new(__("Номер Договора"), 'contract_num'),
                                KeyTextValueAttribute::new(__("Сумма договора"),
                                    sprintf("{{ %s . \" сум \"   . \" ( \" .  %s . \" сум \" . __(\"первоначальный\") . \")\" }}",
                                        self::getWithoutScopeAtrVariable("allToPayShow()"),
                                        self::getWithoutScopeAtrVariable("initial_price_show"))),
                                KeyTextAttribute::new("Товары", "product"),
                                KeyTextAttribute::new(__("Первоначальная оплата"), "initial_price_show"),
                                KeyTextValueAttribute::new(__("Ежемесячный платеж"),
                                    sprintf(
                                        "%s сум \"%s\" ",
                                        self::getAttributeVariable("eachMonthPaymentShow()"),
                                        self::getAttributeVariable("nextPayDate()")
                                    )
                                ),
                                KeyTextAttribute::new(__("Количество месяцев"), 'number_month'),
                                KeyTextAttribute::new(__("Процент"), self::CREDIT_TO . "percent", "%"),
                                $this->penny()
                            ]),
                        ConditionAttribute::new() // annual installment here just change the status !!!
                    ]),
                    ContainerColumn::newClass("flex-1", [
                        BoxTitleContainer::newTitle("Сведения об оплате", "", [
                            new FileLivewireWithoutActionFilterBy("CustomInstallmentShowSuper", CustomMonthlyPaidIndex::new()),
                        ]),
                        BoxTitleContainer::newTitle("Комментарии", "", [
                            CustomCommentDynamic::getDynamicWithoutContainer("CustomInstallmentShow"),
                        ]),
                        BoxTitleContainer::newTitle("Журнал авто списаний", "", [
                            new FileLivewireWithoutActionFilterBy("CustomInstallmentShow", CustomTimeScheduleIndex::new())
                        ]),
                    ])
                ]),
                CustomPlasticCardDynamic::getDynamic("CustomInstallmentShow",),
            ]),

        ]);
    }

}
