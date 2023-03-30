<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInCompelationTime;

class ButtonDaisy extends BaseButtonCompile
{
    public static function new($name, $attributes = []): ButtonDaisy
    {
        return parent::new($name, self::append([
            'class' => "btn "
        ], $attributes));
    }

    public function generateHtml(): string
    {
        return sprintf(
            "<button %s>{{__('%s')}}</button>",
            $this->generateAttributes(),
            $this->name);
    }
}
