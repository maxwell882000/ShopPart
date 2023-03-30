<?php

namespace App\Domain\Core\Front\Admin\DropDown\Items;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionHelperStaticInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireDropItem;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionFormatArg;

abstract class DropLivewireOptional extends DropLivewireItem
    implements FunctionInterface, LivewireDropItem, FunctionHelperStaticInterface
{
    use FunctionFormatArg;

    public function __construct()
    {
        parent::__construct($this->getName(), $this->getFunctionName());
    }

    abstract static protected function getName(): string;

    public function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_TEMPLATE, $this->getFunctionName(),
            $this->formatArguments());
    }

    public function generateDropItems(): string
    {
        return "new \\" . get_called_class() . "()";
    }
}
