<?php

namespace App\Domain\Core\Front\Admin\Templates\Models;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class   BladeGenerator implements HtmlInterface
{
    protected array $items;

    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    public function generateHtml(): string
    {
        $str_items = "";
        foreach ($this->items as $item) {
            $str_items = $str_items . "\n" . $item->generateHtml();
        }
        return $str_items;
    }

    static public function generation(array $items): BladeGenerator
    {
        return new self($items);
    }
}
