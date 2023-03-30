<?php

namespace App\Domain\Installment\Front\Admin\Attributes;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\RedButtonCompile;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputPureAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use App\Domain\Installment\Front\Admin\Functions\DenyInstallment;

class RefuseAttribute implements HtmlInterface
{
    const DENY_FUNCTION = DenyInstallment::FUNCTION_NAME;
    use AttributeGetVariable;

    public function generateHtml(): string
    {
        return Container::new([
            'x-data' => "{ show: false, reason:{}, hold_money: false }"
        ], [
            ButtonDaisy::new("Отказать", [
                'class' => 'btn-error btn-sm',
                '@click' => "show = true"
            ]),
            ModalContainer::new([], [
                Container::new([
                    'class' => "p-5 space-y-4"
                ], [
                    Text::new(self::lang("Отказать рассрочку"), [
                        'class' => "text-2xl block text-center font-bold"
                    ]),
                    Text::new(self::lang("Укажите причину вашего отказа"), [
                        'class' => "text-lg  font-medium"
                    ]),
                    new InputLangAttribute("reason", "Причина", true, "reason"),
                    ContainerRow::newClass("items-center", [
                        Text::new("{{__('Хотите снять деньги ?')}}"),
                        InputPureAttribute::new([
                            "type" => "checkbox",
                            "x-model" => "hold_money"
                        ]),
                    ]),
                    ContainerRow::new([
                        "class" => 'justify-end'
                    ], [
                        Container::new([
                            'class' => "self-end"
                        ], [

                            GrayButtonCompile::new("Отмена", [
                                '@click' => "show = false",
                            ]),
                            RedButtonCompile::new("Отказать", [
                                '@click' => sprintf(
                                    '$wire.set(`reason`,reason); show = false; $wire.%s(hold_money)',
                                    static::DENY_FUNCTION),
                            ])
                        ])
                    ]),
                ])
            ])
        ])->generateHtml();
    }
}
