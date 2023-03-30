<?php

namespace App\Domain\Core\Front\Admin\Attributes\Models;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class EmptyAttribute implements HtmlInterface
{
    public static function new(): EmptyAttribute
    {

        return new static();
    }

    public function generateHtml(): string
    {
        return "";
    }
}
