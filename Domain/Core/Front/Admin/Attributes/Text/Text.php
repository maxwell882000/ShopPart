<?php

namespace App\Domain\Core\Front\Admin\Attributes\Text;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class Text implements HtmlInterface
{
    use GenerateTagAttributes;

    public string $text;

    public function __construct($text, $attributes)
    {
        $this->text = $text;
        $this->attributes = $attributes;
    }

    static public function new(string $text, array $attributes = [])
    {
        return new self($text, $attributes);
    }

    public function generateHtml(): string
    {
        return sprintf("<span %s>%s</span>", $this->generateAttributes(), $this->text);
    }
}
