<?php

namespace App\Domain\Core\Front\Admin\Attributes\Info;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ErrorSuccess implements HtmlInterface
{

  static  public function new()
    {
        return new self();
    }

    public function generateHtml(): string
    {
        return "<x-helper.error.error/>";
    }
}
