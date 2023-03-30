<?php

namespace App\Domain\Core\Front\Admin\Attributes\Spinner;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class Spinner implements HtmlInterface
{
    static public function new(){
        return new self();
    }
    public function generateHtml(): string
    {
        return "<x-helper.spinner.spinner/>";
    }
}
