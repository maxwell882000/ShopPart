<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\TakenCreditEdit;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class MonthlyPaidIndex extends BaseLivewire
{

    
 public $phone; public function sendNotPaid(){return \App\Domain\Installment\Front\Admin\Functions\SmsNotPayment::sendNotPaid($this,...func_get_args());}

    //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.taken-credit-edit.monthly-paid-index'; //4  --- path to blade
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
        return 'App\Domain\Installment\Front\Admin\CustomTables\Tables\MonthlyPaidTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Installment\Front\Nested\MonthlyPaidIndex'; //8  --- class name of entity
    }



}
