<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionHelperInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionFormatArg;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionGenerate;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class AbstractFunctionComponent
    implements FunctionInterface, HtmlInterface, FunctionHelperInterface
{
    use FunctionGenerate, FunctionFormatArg;

    public function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_TEMPLATE,
            $this->getFunctionName(),
            $this->formatArguments());
    }
}
