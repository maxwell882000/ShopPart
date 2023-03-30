<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class InputPureAttribute implements HtmlInterface
{
    use GenerateTagAttributes;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    static public function new($attribute = [])
    {
        return new self($attribute);
    }

    public function generateHtml(): string
    {
        return sprintf("<input %s>", $this->generateAttributes());
    }
}
