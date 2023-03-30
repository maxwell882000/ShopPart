<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\DecisionInstallmentAttribute;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
//2 --- classname livewire
class DecisionAttribute extends BaseEmptyLivewire
{

    
 public $entity;public $reason = []; public function acceptInstallment(){return \App\Domain\Installment\Front\Admin\Functions\AcceptInstallment::acceptInstallment($this,...func_get_args());} public function denyInstallment(){return \App\Domain\Installment\Front\Admin\Functions\DenyInstallment::denyInstallment($this,...func_get_args());} public function requireSurety(){return \App\Domain\Installment\Front\Admin\Functions\RequiredSurety::requireSurety($this,...func_get_args());}

 //3   --- set of functions and variables
    public function getPath():string
  {
    return 'livewire.admin.pages.decision-installment-attribute.decision-attribute'; //4  --- path to blade
  }

    public function getVariable():array
   {

    return [
              //5   --- variable to blade
        ];
    }

}
