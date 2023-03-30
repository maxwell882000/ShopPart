<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseAttributeEmpty implements HtmlInterface
{
    static public function new() {
        $class = get_called_class();
        return new $class();
    }
}
