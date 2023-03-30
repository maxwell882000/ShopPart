<?php

namespace App\Domain\Core\Front\Admin\Attributes\Conditions;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ENDIFstatement implements HtmlInterface
{
   static public function new()
    {
        return new self();
    }

    public function generateHtml(): string
    {
        return ' @endif';
    }
}
