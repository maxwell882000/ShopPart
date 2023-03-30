<?php

namespace App\Domain\CreditProduct\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\File\Models\Main\FileBladeCreatorIndex;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerTitle;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Blade\Base\AllBladeActions;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Admin\Actions\MainCreditEditAction;
use App\Domain\CreditProduct\Front\Admin\Table\MainCreditTable;
use App\Domain\Currency\Front\Attributes\CurrencyAttribute;
use App\Domain\Currency\Front\Attributes\MoneyAttribute;
use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;
use App\Domain\SchemaSms\Front\Attribute\SchemaSmsAttribute;

class MainCreditIndex extends MainCredit implements TableInFront, CreateAttributesInterface
{

    public function getBladeActions(): string
    {
        return AllBladeActions::generation([
            SchemaSmsAttribute::new(SchemaSmsInstallment::class)
        ]);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            Container::new([
                'class' => 'space-y-2  pr-2'
            ], [
                ContainerRow::newClass("justify-between", [
                    ContainerTitle::newTitle("Курс валюты", "border border-blue-300 p-2 bg-white rounded shadow w-max", [
                        new CurrencyAttribute()
                    ]),
                    ContainerTitle::newTitle("Удержка Денег", "border border-blue-300 p-2 bg-white rounded shadow w-max", [
                        new MoneyAttribute()
                    ]),
                ]),
                NestedContainer::new("__(\"Виды рассрочки\")" , [
                    new FileLivewireCreator("MainCredit", $this)
                ]),
            ])
        ]);
    }

    public function getNameIndexAttribute()
    {
        return TextAttribute::generation($this, $this['name_current'], true);
    }

    public function getInitialPriceIndexAttribute()
    {
        return TextAttribute::generation($this, $this->initial_percent . " " . "%", true);
    }

    public function getInitialMonthIndexAttribute()
    {
        $text = __("Нету");
        if ($this->credits()->exists()) {
            $credit = $this->credits()->orderBy('month')->get();
            if ($this->credits()->count() == 1) {
                $text = $credit->first()->month;
            } else {
                $text = __('от') . " " . $credit->first()->month . " "
                    . __("до") . " " . $credit->last()->month;
            }
        }

        return TextAttribute::generation($this, $text, true);
    }

    public function getTableClass(): string
    {
        return MainCreditTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function getTitle(): string
    {
        return "Настройки";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            MainCreditEditAction::new([$this->id]),
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
