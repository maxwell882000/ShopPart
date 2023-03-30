<?php

namespace App\Domain\Core\Front\Admin\Attributes\Models;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionHelperInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionFormatArg;
use App\Domain\Core\Text\Traits\CaseConverter;

class LivewireColumn extends Column implements FunctionHelperInterface
{
    use CaseConverter, FunctionFormatArg;

    const ARGUMENT = "arg";

    function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_TEMPLATE,
            $this->getFunctionName(),
            $this->formatArguments()
        );
    }

    public function getFunctionName(): string
    {
        return $this->toCamelCase($this->key_to_row);
    }

    public function getArguments(): array
    {
        return [
            self::ARGUMENT
        ];
    }
}
