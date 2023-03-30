<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Base;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class AllActions implements HtmlInterface
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function generateHtml(): string
    {
        $str = "<div class='flex flex-row space-x-1 justify-center'>";
        foreach ($this->items as $item) {
            $str = $str . " " . $item->generateHtml();
        }
        $str = $str . " " . "</div>";
        return $str;
    }

    public static function generation(array $items)
    {
        return (new static($items))->generateHtml();
    }
}
