<?php

namespace App\Domain\Installment\CustomInstallment\Front\Main;

use App\Domain\Core\File\Interfaces\BladeActionsInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\Blade\Base\AllBladeActions;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ContainerTextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Actions\CustomInstallmentActionShow;
use App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Tables\CustomInstallmentTable;
use App\Domain\Installment\Front\Admin\CustomTables\Actions\TakenCreditShowAction;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\TakenCreditTable;
use App\Domain\Installment\Front\Traits\TakenIndexTrait;

class CustomInstallmentIndex extends CustomInstallment implements
    TableInFront, CreateAttributesInterface, BladeActionsInterface
{
    use TakenIndexTrait;

    public function getIdPurchaseAttribute()
    {
        return TextAttribute::generation($this, "contract_num");
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, $this->plastic->phone, true);
    }

    public function getClientIndexAttribute()
    {
        return TextAttribute::generation($this, "name");
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("CustomInstallment", $this),
        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            CustomInstallmentActionShow::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return CustomInstallmentTable::class;
    }

    public function getTitle(): string
    {
        return "Ручная Рассрочка";
    }

    function filterByData(): array
    {
        return [];
    }
}
