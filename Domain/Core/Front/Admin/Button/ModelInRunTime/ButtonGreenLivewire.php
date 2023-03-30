<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

class ButtonGreenLivewire extends ButtonLivewire
{
    public function __construct($name, $click, $type = "button")
    {
        parent::__construct($name, $click, "bg-green-600 hover:bg-green-400", $type);
    }


}
