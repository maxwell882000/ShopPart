<?php

namespace App\Http\Livewire\Admin\Pages\ProductEdit;  // 1  --- namespace


use App\Domain\Core\Main\Services\BaseService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamic;
//2 --- classname livewire
class ProductValueWithPriceDynamic extends BaseLivewireDynamic
{


 
 public $index;

    //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.product-edit.product-value-with-price-dynamic'; //4  --- path to blade
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
        return 'App\Domain\Product\ProductKey\Front\CustomTables\ProductValueTableWithPrice'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Product\ProductKey\Front\Dynamic\ProductValueWithPriceDynamic'; //8  --- class name of entity
    }


    public function getServiceClass(): string
    {
        return  'App\Domain\Product\ProductKey\Services\ProductValueService'; //9
    }
}
