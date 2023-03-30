<?php

namespace App\Domain\Installment\Front\Admin\Attributes;

use App\Domain\Core\File\Interfaces\LivewireEmptyInterface;
use App\Domain\Core\File\Interfaces\LivewireEmptyWithPassVariableInterface;
use App\Domain\Core\File\Interfaces\LivewirePassVariableToTag;
use App\Domain\Core\File\Models\Livewire\FileLivewireEmptyCreator;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ELSEstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\DecisionModal;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Containers\Visibility;
use App\Domain\Core\Front\Admin\Attributes\Info\ErrorSuccess;
use App\Domain\Core\Front\Admin\Attributes\Spinner\Spinner;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Front\Admin\Functions\AcceptInstallment;
use App\Domain\Installment\Front\Admin\Functions\DenyInstallment;
use App\Domain\Installment\Front\Admin\Functions\RequiredSurety;
use App\Domain\Installment\Interfaces\PurchaseStatus;

class DecisionAttribute extends Entity implements LivewireEmptyWithPassVariableInterface
{
    use AttributeGetVariable;

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            ErrorSuccess::new(),
            IFstatement::new(sprintf(
                '$entity->status %% 10 == %s', PurchaseStatus::WAIT_ANSWER)),
            Container::new([
                'class' => "p-10 w-full text-center ",
                "wire:key" => "super_secure_key",
                "wire:loading" => null

            ], [
                Spinner::new()
            ]),
            Container::new([
                "wire:key" => "super_secure_key",
                "wire:loading.remove" => ""
            ], [
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
                                "Принять рассрочку",
                                "Вы уверены что хотите принять рассрочку ?",
                                [],
                                [
                                    "wire:click" => AcceptInstallment::FUNCTION_NAME,
                                ])
                        ),
                        new RefuseAttribute(),
                        IFstatement::new(
                            '!$entity->surety && !$entity->isRequiredSurety()',
                            ModalCreator::new(
                                ButtonDaisy::new(
                                    "Требуется поручитель", [
                                    "class" => "btn-sm",
                                    "@click" => "open()"
                                ]), DecisionModal::new(
                                "Запросить поручителя",
                                "Вы уверены что хотите запросить поручителя?", [], [
                                "wire:click" => RequiredSurety::FUNCTION_NAME
                            ])
                            )
                        ),
                        ENDIFstatement::new()
                    ]),
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
            AcceptInstallment::new(),
            DenyInstallment::new(),
            RequiredSurety::new()
        ]);
    }

    public function generateHtml(): string
    {
        return (new FileLivewireEmptyCreator("DecisionInstallmentAttribute", $this))->generateHtml();
    }

    public function generateAdditionalToHtml(): array
    {
        return [
            "entity",
        ];
    }
}
