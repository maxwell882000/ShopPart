<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class NestedContainer implements HtmlInterface
{
    use GenerateTagAttributes;

    public string $title;
    public array $items;

    public function __construct(string $title, array $items = [], array $attributes = [])
    {
        $this->items = $items;
        $this->title = $title;
        $this->attributes = self::append($attributes, [
            'class' => "flex flex-wrap justify-between"
        ]);
    }

    static public function new(string $title, array $items = [], array $attributes = [])
    {
        $self = get_called_class();
        return new $self($title, $items, $attributes);
    }
   // in title there is no __() because we want keep more functionality
    public function generateHtml(): string
    {
        $str = "";
        foreach ($this->items as $item) {
            $str = $str . "\t\t\t\n" . $item->generateHtml();
        }
        return sprintf(
            "<x-helper.container.container :title='%s' %s>
                %s
                </x-helper.container.container>",
            $this->title,
            $this->generateAttributes(),
            $str
        );
    }
}
