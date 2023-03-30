<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseAttributeForm;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ImageCompileAttribute implements HtmlInterface
{
    use AttributeGetVariable, GenerateTagAttributes;

    private string $key;

    public function __construct(string $key, $attributes = [])
    {
        $this->key = $key;
        $this->attributes = $attributes;
    }

    public static function new(string $key, $attributes = [])
    {
        return new self($key, $attributes);
    }

    public function generateHtml(): string
    {
        return sprintf("<x-helper.image.image %s>%s</x-helper.image.image>",
            $this->generateAttributes(),
            $this->getAttributeVariable($this->key . "->" . "storage()"),
        );
    }
}
