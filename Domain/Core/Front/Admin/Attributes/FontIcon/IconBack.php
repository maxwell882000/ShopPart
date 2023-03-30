<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

class IconBack extends Icon
{
    public static function new(array $attributes)
    {
        return new self(self::append(['class' => "text-gray-500 hover:text-gray-300  text-xl fas fa-undo-alt"], $attributes));
    }

}
