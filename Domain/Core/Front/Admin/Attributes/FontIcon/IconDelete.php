<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

class IconDelete extends Icon
{
    public static function new(array $attributes)
    {
        return new self(self::append(['class' => "text-red-500 hover:text-red-300 text-xl  fas fa-trash"], $attributes));
    }

}
