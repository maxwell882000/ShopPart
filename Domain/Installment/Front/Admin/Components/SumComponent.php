<?php

namespace App\Domain\Installment\Front\Admin\Components;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseAttributeEmpty;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class SumComponent extends BaseAttributeEmpty
{

    public function generateHtml(): string
    {
        return "<x-installment.sum/>";
    }
}
