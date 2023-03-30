<?php

namespace App\Domain\Product\Product\Front\Admin\Livewire\Attribute;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;

class ModelProductAttribute implements LivewireAdditionalFunctions , FunctionStandardTemplate
{
    const NAME = "entitiesStore";


    public function generateFunctions(): string
    {
        return sprintf('public $%s = [];', self::NAME);
    }
}
