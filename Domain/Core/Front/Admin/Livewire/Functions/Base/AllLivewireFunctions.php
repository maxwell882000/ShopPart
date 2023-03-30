<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Base;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;

class AllLivewireFunctions implements LivewireAdditionalFunctions
{
    public array $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    static public function generation(array $array)
    {
        return new self($array);
    }

    public function generateFunctions(): string
    {
        $str = '';
        foreach ($this->item as $item) {
            $str = $str . ' ' . $item->generateFunctions();
        }
        return $str;
    }
}
