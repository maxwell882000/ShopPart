<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\Color;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class ColorIndex extends BaseLivewire
{

    


  //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.color.color-index'; //4  --- path to blade
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
        return 'App\Domain\Common\Colors\Front\Admin\CustomTable\Table\ColorTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Common\Colors\Front\Main\ColorIndex'; //8  --- class name of entity
    }



}
