<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Interfaces;

use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionGeneratorInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

interface TableInFront extends FunctionGeneratorInterface, TableActionInterface
{
    public function getTableClass(): string;

    public function livewireComponents(): LivewireComponents;

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown;

    public function getTitle(): string;


}
