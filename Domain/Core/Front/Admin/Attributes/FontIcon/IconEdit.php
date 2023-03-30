<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

class IconEdit extends Icon
{
    public static function new(array $attributes)
    {
        return new self(self::append(['class' => "text-blue-500 hover:text-blue-300 text-xl  fas fa-edit"], $attributes));
    }

}
