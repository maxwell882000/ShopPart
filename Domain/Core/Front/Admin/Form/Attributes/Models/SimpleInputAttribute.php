<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class SimpleInputAttribute implements HtmlInterface
{
    use GenerateTagAttributes;

    public function __construct(array $attribute)
    {
        $this->attributes = $attribute;
    }

    static public function new(array $attribute = [])
    {
        return new static($attribute);
    }

    public function generateHtml(): string
    {
        return sprintf("x-helper.input.input %s />", $this->generateAttributes());
    }
}
