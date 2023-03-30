<?php

namespace App\Domain\CreditProduct\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\CreditProduct\Entity\Credit;
use App\Domain\CreditProduct\Front\Admin\Table\CreditDynamicTable;
use App\Domain\CreditProduct\Services\CreditService;

class CreditDynamicWithoutEntity extends Credit implements TableInFront
{
    use TableDynamicWithoutEntity;

    public function getTableClass(): string
    {
        return CreditDynamicTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

            ]
        );
    }

    /**
     *
     */
    public function getTitle(): string
    {
        return "Кредиты на каждый месяц";
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    static public function getPrefixInputHidden(): string
    {
        return "credits";
    }
}
