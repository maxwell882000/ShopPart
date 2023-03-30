<?php

namespace App\Domain\Installment\CustomInstallment\Front\Main;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerWrap;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputPureAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Front\Js\Interfaces\FilterJsInterface;
use App\Domain\CreditProduct\Front\Admin\DropDown\CreditDropDownAssociated;
use App\Domain\CreditProduct\Front\Admin\DropDown\MainCreditDropDownRelation;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Admin\Attributes\PlasticAttribute;
use App\Domain\Installment\Front\Admin\Components\SumComponent;
use App\Domain\Installment\Front\Admin\Dispatch\DispatchCredit;

class CustomInstallmentCreate extends CustomInstallment implements CreateAttributesInterface
{
    use AttributeGetVariable;

    public function container(string $text, int $current)
    {
        return Container::new([
            'class' => "flex-1 p-2 text-white ",
            ":class" => sprintf("show == %s ? \"bg-[#2489cc]\" : \"bg-[#BBBBBB]\"", $current)
        ], [
            Text::new($text)
        ]);
    }

    public function header()
    {
        return ContainerRow::new([
            'class' => "space-x-0"
        ], [
            $this->container("Детали", 0),
            $this->container("Договор", 1),
            $this->container("Подтверждение", 2)
        ]);
    }

    public function title(string $text)
    {
        return Container::new([
            "class" => "w-full border-t border-[#DDD] h-0 text-center"
        ], [
            Text::new($text, [
                'class' => "relative top-[-11px] bg-[#FAFAFA] text-[#3498db] p-2"
            ])
        ]);
    }

    public function detail()
    {
        return ContainerWrap::new([
            "x-show" => "show === 0",
            'x-data' => "{price_value: 0}"
        ], [
            $this->title("Детали рассрочки"),
            SumComponent::new(),
            MainCreditDropDownRelation::newCredit(
                CreditDropDownAssociated::class,
                DispatchCredit::class),
            InputAttribute::createAttribute("price",
                "number", "Сумма договора",
                "price", "pay-full"
            ),
//            InputPuxreAttribute::new([
//                'class' => 'hidden',
//                "@pay-full-total.window" => "price_value = \$event.detail.price",
//                "x-model" => "price_value",
//                "name" => "price",
//            ]),
            InputAttribute::createAttribute("initial_price",
                "number", "Первоначальная плата",
                "initial_payment", "pay-update"
            ),
            InputAttribute::createAttribute(
                "payment_type",
                'checkbox',
                "Уплачен на кассе",
                "initial_pay",
            ),
            InputAttribute::createAttribute(
                "penny",
                "text",
                "Пенни", "", "",
                FilterJsInterface::ONLY_NUMBER),
            $this->title("Детали карты"),
            new PlasticAttribute(),
            $this->button("Далее", [
                "@click" => "show = 1"
            ])
        ]);
    }

    public function button(string $name, array $attribute = [])
    {
        return ContainerRow::new([
            'class' => "justify-end w-full py-2"
        ], [
            Container::new([], [
                MainButtonCompile::new($name, $attribute),
            ])
        ]);
    }

    public function agreement()
    {
        return ContainerWrap::new([
            "x-show" => "show === 1",
        ], [
            InputAttribute::createAttribute("name", "text", "Ф.И.O клиента"),
            InputAttribute::init("phone", "text", "Телефонный номер", [
                "@plastic-phone.window" => "phone = \$event.detail.value",
                "x-model" => "phone"
            ]),
            new TextAreaAttribute("product", "Товары"),
            ContainerRow::new([
                'class' => "justify-end w-full py-2"
            ], [

                GrayButtonCompile::new("Назад", [
                    "class" => "m-0",
                    "@click" => "show = 0"
                ]),
                MainButtonCompile::new("Сохранить", [
                    "class" => "m-0",
                    'type' => "submit",
                    "id" => "real_submit"
                ])
            ])
        ]);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            Container::new([
                "class" => "w-full justify-between",
                'x-data' => "installment()",
            ], [
                $this->header(),
                $this->detail(),
                $this->agreement()
            ]),
        ]);
    }
}
