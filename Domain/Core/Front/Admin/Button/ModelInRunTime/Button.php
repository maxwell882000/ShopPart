<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

use App\Domain\Core\Front\Admin\Button\BaseButton\BaseButton;
use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;

class Button extends BaseButton
{
    use GenerateTagAttributes;

    public function __construct($name, $attributes)
    {
        $this->attributes = $attributes;
        parent::__construct($name);
    }

    public static function new($name, $attributes = [])
    {
        return new self($name, $attributes);
    }

    public function generateHtml(): string
    {
        return sprintf("<button %s> %s</button>", $this->generateAttributes(), $this->name);
    }
}
