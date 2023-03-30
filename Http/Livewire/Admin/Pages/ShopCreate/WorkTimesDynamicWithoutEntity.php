<?php

namespace App\Http\Livewire\Admin\Pages\ShopCreate;  // 1  --- namespace


use App\Domain\Core\Main\Services\BaseService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamicWithoutEntity;
//2 --- classname livewire
class WorkTimesDynamicWithoutEntity extends BaseLivewireDynamicWithoutEntity
{


     


    //3   --- set of functions and variables
    public function getPath()
{
    return 'livewire.admin.pages.shop-create.work-times-dynamic-without-entity'; //4  --- path to blade
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
    return 'App\Domain\Shop\Front\Admin\CustomTable\Tables\WorkTimesDynamicTable'; //7  --- class name of table
}

    public function getEntity(){
    return 'App\Domain\Shop\Front\Dynamic\WorkTimesDynamicWithoutEntity'; //8  --- class name of entity
}


}
