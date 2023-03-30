<?php


namespace App\Http\Livewire\Admin\Base\Dropdown\Model;


abstract class DoubleDropDownLivewireComponent extends DropDownLivewireComponent
{
    abstract public function updateModelSecond($id, $path);
}
