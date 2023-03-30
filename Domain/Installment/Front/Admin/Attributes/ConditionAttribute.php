<?php

namespace App\Domain\Installment\Front\Admin\Attributes;

use App\Domain\Core\File\Interfaces\LivewireEmptyInterface;
use App\Domain\Core\File\Interfaces\LivewireEmptyWithPassVariableInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireEmptyCreator;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\DecisionModal;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\RedButtonCompile;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Front\Admin\Functions\AnnulledInstallment;
use App\Domain\Installment\Front\Admin\Functions\RequiredSurety;
use App\Domain\Installment\Interfaces\PurchaseStatus;

class ConditionAttribute extends Entity implements LivewireEmptyWithPassVariableInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            IFstatement::new(
                sprintf('abs($entity->status)%% 10 == %s', PurchaseStatus::ACCEPTED)),
            BoxTitleContainer::newTitle("Состояние", "", [
                KeyTextAttribute::new(__("Сальдо"), 'saldo_show', "",
                    '@if($entity->saldo < 0) text-red-400 @endif'),
                IFstatement::new(sprintf('$entity->status != %s', PurchaseStatus::ANNULLED)),
                Container::newClass("m-auto w-2/5", [
                    ModalCreator::new(
                        RedButtonCompile::new("Аннулировать рассрочку", [
                            '@click' => "open()",
                        ]), DecisionModal::new(
                        "Аннулировать рассрочку",
                        "Вы уверены что хотите аннулировать рассрочку?", [], [
                        "wire:click" => AnnulledInstallment::FUNCTION_NAME
                    ])
                    ),
                ]),
                ENDIFstatement::new()

            ]),
            ENDIFstatement::new()
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            VariableGenerator::new($this->generateAdditionalToHtml()),
            AnnulledInstallment::new()
        ]);
    }

    public function generateHtml(): string
    {
        return (new FileLivewireEmptyCreator("ConditionAttribute", $this))->generateHtml();
    }

    public function generateAdditionalToHtml(): array
    {
        return [
            "entity",
        ];
    }
}
