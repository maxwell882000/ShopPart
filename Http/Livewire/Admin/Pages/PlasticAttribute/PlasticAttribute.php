<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\PlasticAttribute;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
//2 --- classname livewire
class PlasticAttribute extends BaseEmptyLivewire
{

    
 public $card_number;public $date_number;public $transaction_id;public $code;public $plastic_id; public function sendSms(){return \App\Domain\Installment\CustomInstallment\Front\Admin\Functions\SendCodeForPlasticLivewire::sendSms($this,...func_get_args());}public function getCode(){return \App\Domain\Installment\CustomInstallment\Front\Admin\Functions\SendCodeForPlasticLivewire::getCode($this,...func_get_args());}

 //3   --- set of functions and variables
    public function getPath():string
  {
    return 'livewire.admin.pages.plastic-attribute.plastic-attribute'; //4  --- path to blade
  }

    public function getVariable():array
   {

    return [
              //5   --- variable to blade
        ];
    }

}
