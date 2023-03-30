<?php

namespace App\Http\Livewire\Admin\Pages\MainCredit;  // 1  --- namespace


use App\Domain\Core\Main\Services\BaseService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamic;
//2 --- classname livewire
class CreditDynamicIndex extends BaseLivewireDynamic
{


 


   //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.main-credit.credit-dynamic-index'; //4  --- path to blade
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
        return 'App\Domain\CreditProduct\Front\Admin\Table\CreditDynamicTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\CreditProduct\Front\Dynamic\CreditDynamicIndex'; //8  --- class name of entity
    }


    public function getServiceClass(): string
    {
        return  'App\Domain\CreditProduct\Services\CreditService'; //9
    }
}
