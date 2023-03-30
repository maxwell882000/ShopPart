<?php

namespace App\Domain\Core\Front\Interfaces;

use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

interface FrontEntityInterface
{
    public function livewireComponents(): LivewireComponents;

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown;

    public function livewireFunctions(): LivewireAdditionalFunctions;

}
