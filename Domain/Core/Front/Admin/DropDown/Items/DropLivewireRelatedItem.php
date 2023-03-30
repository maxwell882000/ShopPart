<?php

namespace App\Domain\Core\Front\Admin\DropDown\Items;

class DropLivewireRelatedItem extends DropLivewireItem
{
    public function __construct($id, $name)
    {
        parent::__construct($name, sprintf("setParent('%s')", $id));
    }
}
