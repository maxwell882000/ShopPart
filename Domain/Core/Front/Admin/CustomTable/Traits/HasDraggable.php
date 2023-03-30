<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;

trait HasDraggable
{
    protected function pathToBlade(): string
    {
        return "helper.table.table_draggable";
    }

    abstract public function functionObject(): AbstractFunction;

    public function generateFunctions(): string
    {
        $str_function = parent::generateFunctions();
        return $str_function . " " . $this->functionObject()->generateFunctions();
    }
}
