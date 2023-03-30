<?php

namespace App\Domain\Core\Front\Admin\DropDown\Items;

class DropLivewireAssociatedItem extends DropLivewireItem
{
    public function __construct($id, $name)
    {
        parent::__construct($name, sprintf("setChild('%s')", $id));
    }
}
