<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use Illuminate\View\ComponentAttributeBag;

class IconAdd extends Icon
{

    public static function new(array $attributes)
    {
        return new self(self::append(['class' => "text-green-500 hover:text-green-300 text-3xl fas fa-plus-circle"], $attributes));
    }


}
