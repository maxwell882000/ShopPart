<?php


namespace App\Domain\Core\Front\Admin\DropDown\Items;

use App\Domain\Core\Front\Admin\DropDown\Interfaces\DropItemInterfaces;

class DropItem
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

}
