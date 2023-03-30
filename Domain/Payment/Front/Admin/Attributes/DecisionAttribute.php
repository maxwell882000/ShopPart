<?php

namespace App\Domain\Payment\Front\Admin\Attributes;

use App\Domain\Core\File\Interfaces\LivewireEmptyWithPassVariableInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireEmptyCreator;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\DecisionModal;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Info\ErrorSuccess;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Payment\Front\Admin\Functions\AcceptPayment;
use App\Domain\Payment\Front\Admin\Functions\DenyPayment;
use App\Domain\Payment\Interfaces\PaymentStatus;

class DecisionAttribute extends Entity implements LivewireEmptyWithPassVariableInterface
{


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            ErrorSuccess::new(),
            IFstatement::new(sprintf(
                '$entity->status%%10 == %s', PaymentStatus::WAIT_ANSWER)),
            BoxTitleContainer::newTitle("Решение", "", [
                ContainerRow::new([
                    "data-theme" => 'custom',
                    "class" => "space-x-4 justify-around"], [
                    ModalCreator::new(
                        ButtonDaisy::new("Принять", [
                            'class' => 'btn-success btn-sm',
                            "@click" => 'open()',
                        ]),
                        DecisionModal::new(
                            "Принять заказ",
                            "Вы уверены что хотите принять заказ ?",
                            [],
                            [
                                "wire:click" => AcceptPayment::FUNCTION_NAME,
                            ])
                    ),
                    new \App\Domain\Payment\Front\Admin\Attributes\RefuseAttribute()
                ]),
            ]),
            ENDIFstatement::new()
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            VariableGenerator::new(
                array_merge($this->generateAdditionalToHtml(), [
                    'reason = []'
                ])),
            AcceptPayment::new(),
            DenyPayment::new(),
        ]);
    }

    public function generateAdditionalToHtml(): array
    {
        return [
            'entity',
//            'reason = []'
        ];
    }

    public function generateHtml(): string
    {
        return (new FileLivewireEmptyCreator("DecisionAttributeForPayment", $this))->generateHtml();
    }
}
