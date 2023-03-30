<?php

namespace App\Http\Livewire\Admin\Pages\CustomInstallmentShow;  // 1  --- namespace


use App\Domain\Core\Main\Services\BaseService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamic;
//2 --- classname livewire
class CustomCommentDynamic extends BaseLivewireDynamic
{


 


   //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.custom-installment-show.custom-comment-dynamic'; //4  --- path to blade
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
        return 'App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Tables\CustomCommentTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Installment\CustomInstallment\Front\Dynamic\CustomCommentDynamic'; //8  --- class name of entity
    }


    public function getServiceClass(): string
    {
        return  'App\Domain\Installment\CustomInstallment\Services\CustomCommentInstallmentService'; //9
    }
}
