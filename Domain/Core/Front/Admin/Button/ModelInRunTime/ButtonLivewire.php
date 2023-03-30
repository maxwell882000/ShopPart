<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

use App\Domain\Core\Front\Admin\Button\BaseButton\BaseButton;
use App\View\Components\Button\ButtonLivewireComponent;

class ButtonLivewire extends BaseButton
{
    public string $click;
    public string $class;
    public string $type;

    public function __construct($name, $click, $class, $type = "button")
    {
        parent::__construct($name);
        $this->click = $click;
        $this->class = $class;
        $this->type = $type;
    }

    public function generateHtml(): string
    {
        $button = new ButtonLivewireComponent(
            $this->name,
            $this->click,
            $this->class,
            $this->type
        );
        return $button->render()->with($button->data())->render();
    }

    public static function new($name, $click)
    {
        $self = get_called_class();
        $class = new $self($name, $click);
        return $class;
    }

    public static function generate($name, $click, $type = "button"): string
    {
        $class = get_called_class();
        $self = new $class($name, $click, $type);
        return $self->generateHtml();
    }
}
