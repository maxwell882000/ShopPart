<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Traits;

trait FunctionFormatArg
{
    protected function formatArguments(): string
    {
        $new_array = [];
        foreach ($this->getArguments() as $argument) {
            array_push($new_array, "$" . $argument);
        }
        return implode(",", $new_array);
    }
}
