<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInRunTime;

class ButtonRedLivewire extends ButtonLivewire
{
    public function __construct($name, $click, $type = 'button')
    {
        parent::__construct($name, $click, "bg-red-600 hover:bg-red-400", $type);
    }
}
