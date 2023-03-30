<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\Lenta;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class LentaIndex extends BaseLivewire
{

    


    //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.lenta.lenta-index'; //4  --- path to blade
    }

    public function getVariable()
    {
        $this->includeSearch();
        $table = $this->getTable();
        return [
            "table" => new $table($this->getLists()),
              //5   --- variable to blade
        ];
    }
    public function getItemsToOptionalDropDown():array{
        return [
             // 6  --- optional dropdown items
        ];
    }
    public function getTable(){
        return 'App\Domain\Lenta\Front\Admin\CustomTable\Tables\LentaTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Lenta\Front\Main\LentaIndex'; //8  --- class name of entity
    }



}
