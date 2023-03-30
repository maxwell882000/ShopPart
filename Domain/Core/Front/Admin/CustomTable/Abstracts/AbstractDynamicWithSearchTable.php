<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;

abstract class AbstractDynamicWithSearchTable extends AbstractDynamicTable
{
    public function generateHtml(): string
    {
        $str = parent::generateHtml();
        return "
            <div class=\"w-full\">
                <x-helper.input.input wire:model=\"search\" label='{{__(\"Поиск по списку\")}}'/>
            </div>
            $str";
    }
}
