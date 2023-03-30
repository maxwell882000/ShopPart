<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

class ButtonBlueLivewire extends ButtonLivewire
{
    public function __construct($name, $click, $type = "button")
    {
        parent::__construct($name, $click, "bg-blue-600 hover:bg-blue-400", $type);
    }
}
