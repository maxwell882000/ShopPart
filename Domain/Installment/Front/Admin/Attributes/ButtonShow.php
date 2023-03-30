<?php

namespace App\Domain\Installment\Front\Admin\Attributes;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ButtonShow implements HtmlInterface
{

    public function generateHtml(): string
    {
        return "<button @click='open()' class='icon_action'> <span class='fa fa-file-invoice-dollar'></span></button>";
    }
}
