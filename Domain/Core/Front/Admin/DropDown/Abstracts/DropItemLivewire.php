<?php


namespace App\Domain\Core\Front\Admin\DropDown\Abstracts;

use App\Domain\Core\Front\Admin\DropDown\Interfaces\DropItemInterfaces;

// variable function
abstract class DropItemLivewire implements DropItemInterfaces
{


    public $name;
    public $id;
    public $clicked;

    public function __construct($id, string $name, string $clicked) // nothing in the constructor
    {
        $this->id = $id;
        $this->name = $name;
        $this->clicked = $clicked;
    }

    public function setPathToClicked(...$value)
    {
        $this->clicked = sprintf($this->getFormat(), $this->getFunction(), ...$value);
    }

    public function getFunction(): string
    {
        return "clickDropDown";
    }

    public function getFormat(): string
    {
        return "%s('%s', '%s')";
    }
}
