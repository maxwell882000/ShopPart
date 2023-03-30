<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

class ButtonGrayLivewire extends ButtonLivewire
{
    public function __construct($name, $click, $type = "button")
    {
        parent::__construct($name, $click, "bg-gray-600 hover:bg-gray-400", $type);
    }
}
