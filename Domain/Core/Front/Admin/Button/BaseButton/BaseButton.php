<?php

namespace App\Domain\Core\Front\Admin\Button\BaseButton;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseButton implements HtmlInterface
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

}
