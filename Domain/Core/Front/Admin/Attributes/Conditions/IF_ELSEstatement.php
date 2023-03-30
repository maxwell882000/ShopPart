<?php

namespace App\Domain\Core\Front\Admin\Attributes\Conditions;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class IF_ELSEstatement extends IFstatement
{
    protected function command()
    {
        return "else if";
    }
}
