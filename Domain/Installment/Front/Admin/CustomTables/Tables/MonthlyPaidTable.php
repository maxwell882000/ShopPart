<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Info\ErrorSuccess;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Installment\Front\Admin\Functions\SmsNotPayment;

class MonthlyPaidTable extends AbstractTable
{
    use AttributeGetVariable;

    public function getColumns(): array
    {
        return [
            Column::new(__("Месяц"), "month_index"),
            Column::new(__("Оплата"), "paid_index"),
            Column::new(__("Статус"), "status_index")
        ];
    }

    public function slot(): string
    {
        return ContainerRow::generateClass("justify-end items-end", [
            ErrorSuccess::new(),
            Container::new([],
                [
                    ModalCreator::new(
                        MainButtonCompile::new("Выставить счет", [
                            "@click" => "open()"
                        ]),
                        ModalContainer::new([], [
                            Container::new([
                                'class' => 'block p-5 space-y-4',
                            ], [
                                Text::new(self::lang("Отправка сообщения"), [
                                    'class' => "text-2xl block text-center font-bold"
                                ]),
                                Text::new(self::lang("Вы уверены что хотите выставить счёт ?"), [
                                    'class' => "text-lg  font-medium"
                                ]),
                                InputAttribute::init("phone", "number", "Введите номер телефона", [
                                    "wire:model.defer" => "phone"
                                ]),
                                ContainerRow::new([
                                    "class" => 'pt-1 justify-end'
                                ], [
                                    Container::new([
                                        'class' => "self-end"
                                    ], [
                                        GrayButtonCompile::new("Назад", [
                                            "@click" => "show = false"
                                        ]),
                                        MainButtonCompile::new("Отправить", [
                                            '@click' => "show = false",
                                            "wire:click" => $this->sendSMS()
                                        ])
                                    ])
                                ]),
                            ])
                        ]),
                    )
                ])
        ]);
    }

    public function sendSMS()
    {
        return SmsNotPayment::FUNCTION_NAME;
    }

    public function turnOffActions(): string
    {
        return "1";
    }

}
