<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ContainerTextAttribute implements HtmlInterface
{
    public string $class;
    public TextAttribute $text;

    public function __construct(string $class, TextAttribute $text)
    {
        $this->class = $class;
        $this->text = $text;
    }

    public static function generation(string $class, TextAttribute $textAttribute)
    {
        return (new self($class, $textAttribute))->generateHtml();
    }

    public function generateHtml(): string
    {
        return Container::generateClass('p-1 rounded text-white '. $this->class, [
            $this->text
        ]);
    }
}
