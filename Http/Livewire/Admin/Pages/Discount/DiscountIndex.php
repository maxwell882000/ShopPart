<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\Discount;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class DiscountIndex extends BaseLivewire
{

   


     public function statusTable($arg){ $entity = $this->getEntity()::find($arg);
             $entity->status = !$entity->status;
             $entity->save();}   //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.discount.discount-index'; //4  --- path to blade
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
        return 'App\Domain\Common\Discounts\Front\Admin\CustomTables\Tables\DiscountTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Common\Discounts\Front\Main\DiscountIndex'; //8  --- class name of entity
    }



}
