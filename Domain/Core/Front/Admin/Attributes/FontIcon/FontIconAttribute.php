<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class FontIconAttribute implements HtmlInterface
{
    use GenerateTagAttributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    static public function new(array $attributes)
    {
        $self = get_called_class();
        return new $self($attributes);
    }

    public function generateHtml(): string
    {
        return sprintf("<span %s></span>", $this->generateAttributes());
    }
}
