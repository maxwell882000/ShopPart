<?php

namespace App\Domain\CreditProduct\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\CreditProduct\Entity\Credit;
use App\Domain\CreditProduct\Front\Admin\Table\CreditDynamicTable;
use App\Domain\CreditProduct\Services\CreditService;

class CreditDynamicIndex extends CreditDynamicWithoutEntity
{
    use TableDynamic;

    public static function getBaseService(): string
    {
        return CreditService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return "main_credit_id";
    }

}
