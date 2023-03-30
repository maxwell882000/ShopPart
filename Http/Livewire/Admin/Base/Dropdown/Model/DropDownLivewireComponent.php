<?php


namespace App\Http\Livewire\Admin\Base\Dropdown\Model;


use App\Domain\Core\Language\Traits\ConvertLanguage;
use App\Http\Livewire\Admin\Base\DropDown\Interfaces\DropDownLivewireComponentInterface;
use Livewire\Component;

abstract class DropDownLivewireComponent extends Component implements DropDownLivewireComponentInterface
{
//    use PathHandler, ConvertLanguage;
//
//    protected function getDropDownLivewire($path)
//    {
//        return $this->decodePath($path)::getDropDownLivewire();
//    }
//
//    protected function getChosenName(array $drop, $id)
//    {
//        return collect($drop[0]->items)->where("id", "=", $id)->first()->name;
//    }
//
//    protected function setNameDropDown(array $drop, $id)
//    {
//        $drop[0]->name = $this->getChosenName($drop, $id);
//    }
}
