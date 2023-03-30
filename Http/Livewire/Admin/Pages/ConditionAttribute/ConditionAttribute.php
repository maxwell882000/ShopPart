<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\ConditionAttribute;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
//2 --- classname livewire
class ConditionAttribute extends BaseEmptyLivewire
{

    
 public $entity; public function annulling(){return \App\Domain\Installment\Front\Admin\Functions\AnnulledInstallment::annulling($this,...func_get_args());}

 //3   --- set of functions and variables
    public function getPath():string
  {
    return 'livewire.admin.pages.condition-attribute.condition-attribute'; //4  --- path to blade
  }

    public function getVariable():array
   {

    return [
              //5   --- variable to blade
        ];
    }

}
