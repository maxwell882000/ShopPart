<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Base;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireDropItem;

class AllLivewireOptionalDropDown implements LivewireAdditionalFunctions, LivewireDropItem
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
    public static  function generation(array $items) {
        return new self($items);
    }
    public function generateFunctions(): string
    {
        $str_functions = "";

        foreach ($this->items as $item) {
            $str_functions = $str_functions . " " . $item->generateFunction();
        }
        return $str_functions;
    }


    public function generateDropItems(): string
    {
        $str_items = "";
        foreach ($this->items as $item) {
            $str_items = $item->generateDropItems() . "," . $str_items;
        }
        return $str_items;
    }
}
