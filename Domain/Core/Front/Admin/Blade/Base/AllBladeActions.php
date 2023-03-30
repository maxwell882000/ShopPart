<?php

namespace App\Domain\Core\Front\Admin\Blade\Base;

use App\Domain\Core\File\Interfaces\BladeActionsInterface;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use phpDocumentor\Reflection\File;

class AllBladeActions implements BladeActionsInterface
{
    public array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    static public function generation(array $items = [])
    {
        return (new self($items))->getBladeActions();
    }

    public function getBladeActions(): string
    {
        $str = "";
        foreach ($this->items as $item) {
            $str = $str . $item->generateHtml();
        }
        return $str;
    }
}
