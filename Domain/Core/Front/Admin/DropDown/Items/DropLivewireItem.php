<?php

namespace App\Domain\Core\Front\Admin\DropDown\Items;

class DropLivewireItem extends DropItem
{
    public $clicked;
    public $class;

    public function __construct( $name, $clicked, $class = "")
    {
        parent::__construct("", $name);
        $this->clicked = $clicked;
        $this->class = $class;
    }

}
