<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInCompelationTime;

use App\Domain\Core\Front\Admin\Button\BaseButton\BaseButton;
use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;

class BaseButtonCompile extends BaseButton
{
    use GenerateTagAttributes;

    public function __construct($name, $attributes = [])
    {
        parent::__construct($name);
        $this->attributes = $attributes;
    }

  static  public function new($name, $attributes = [])
    {
        $self = get_called_class();
        return new $self($name, $attributes);
    }

    public function generateHtml(): string
    {
        return sprintf(
            "<x-helper.button.base_button %s>%s</x-helper.button.base_button>",
            $this->generateAttributes(),
            $this->name);
    }
}
