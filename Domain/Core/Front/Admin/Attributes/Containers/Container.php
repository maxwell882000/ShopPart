<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class Container implements HtmlInterface
{
    use GenerateTagAttributes;

    public array $items;

    public function __construct(array $items, array $attributes = [])
    {
        $this->items = $items;
        $this->attributes = $attributes;
    }

    static public function newClass(string $class = "", array $item = []): Container
    {
        $self = get_called_class();
        return new $self($item, ['class' => $class]);
    }

    static public function new(array $attributes = [], array $item = [])
    {
        $self = get_called_class();
        return new $self($item, $attributes);
    }

    static public function  generate(array $attributes, array $items): string
    {
        return self::new($attributes, $items)->generateHtml();
    }

    static public function generateClass(string $class = "", array $item = []): string
    {
        return self::newClass($class, $item)->generateHtml();
    }


    protected function generateItems(): string
    {
        $str = "";
        foreach ($this->items as $item) {
            $str = $str . "\t\t\t\n" . $item->generateHtml();
        }
        return $str;
    }

    public function generateHtml(): string
    {

        return sprintf(
            "
            <div %s>
                %s
            </div>", $this->generateAttributes(), $this->generateItems());
    }
}
