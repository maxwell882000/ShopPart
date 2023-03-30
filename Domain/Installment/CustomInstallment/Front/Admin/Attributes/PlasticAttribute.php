<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Attributes;

use App\Domain\Core\File\Interfaces\LivewireEmptyInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireEmptyCreator;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Info\ErrorSuccess;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Front\Js\Interfaces\FilterJsInterface;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\CustomInstallment\Front\Admin\Functions\SendCodeForPlasticLivewire;

class PlasticAttribute extends Entity implements LivewireEmptyInterface
{
    use AttributeGetVariable;

    public function generateHtml(): string
    {
        return (new FileLivewireEmptyCreator("PlasticAttribute", $this))->generateHtml();
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            ErrorSuccess::new(),
            InputAttribute::init("plastic_id", "text", "", [
                'class' => 'hidden',
                'wire:model' => "plastic_id"
            ]),
            ContainerRow::new([
                'class' => 'items-end'
            ], [
                InputAttribute::init(
                    "card_number", "text",
                    "Номер карты", [
                        "id" => "card_number",
                        "oninput" => FilterJsInterface::FORMAT_CARD_NUMBER,
                        "placeholder" => "**** **** **** ****",
                        "wire:model.defer" => "card_number"
                    ]
                ),
                Container::new([
                    'class' => "w-32"
                ], [
                    InputAttribute::init(
                        "date_number", "text",
                        "Срок годности", [
                            "id" => "date_number",
                            "oninput" => FilterJsInterface::FORMAT_DATE_FOR_CARD,
                            "placeholder" => "mm/yy",
                            "wire:model.defer" => "date_number"
                        ]
                    ),
                ]),
                ModalCreator::new(
                    MainButtonCompile::new("Получить код", [
//                    "@click" => "open()",
                        "wire:click" => SendCodeForPlasticLivewire::SEND_SMS,
                    ]),
                    ModalContainer::new([], [
                        Container::new([
                            'class' => 'block p-5 space-y-4',
                        ], [
                            ErrorSuccess::new(),
                            Text::new(self::lang("Получить код"), [
                                'class' => "text-2xl block text-center font-bold"
                            ]),
                            InputAttribute::createAttribute("code", "number", "Введите код"),
                            Container::new([
                                'class' => "self-end"
                            ], [
                                GrayButtonCompile::new("Отмена", [
                                    '@click' => "show = false"
                                ]),
                                MainButtonCompile::new("Подтвердить", [
                                    "wire:click" => SendCodeForPlasticLivewire::GET_CODE
                                ])
                            ])
                        ])
                    ]),
                    [
                        "@open-dialog.window" => "open()",
                        "@close-dialog.window" => "show = false"
                    ]
                ),
            ])
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            VariableGenerator::new([
                'card_number',
                'date_number',
                'transaction_id',
                'code',
                'plastic_id'
            ]),
            SendCodeForPlasticLivewire::new()
        ]);
    }

}
