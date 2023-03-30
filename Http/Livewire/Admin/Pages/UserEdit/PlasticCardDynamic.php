<?php

namespace App\Http\Livewire\Admin\Pages\UserEdit;  // 1  --- namespace


use App\Domain\Core\Main\Services\BaseService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamic;
//2 --- classname livewire
class PlasticCardDynamic extends BaseLivewireDynamic
{


 
 public function sendSms(){return \App\Domain\User\Front\Admin\Functions\SendSmsLivewire::sendSms($this,...func_get_args());}

    //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.user-edit.plastic-card-dynamic'; //4  --- path to blade
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
        return 'App\Domain\User\Front\Admin\CustomTable\Tables\PlasticDynamicTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\User\Front\Dynamic\PlasticCardDynamic'; //8  --- class name of entity
    }


    public function getServiceClass(): string
    {
        return  'App\Domain\User\Services\PlasticCardService'; //9
    }
}
