<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\Payment;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class PaymentIndex extends BaseLivewire
{

   


      //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.payment.payment-index'; //4  --- path to blade
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
        return 'App\Domain\Payment\Front\Admin\CustomTables\Tables\PaymentTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Payment\Front\Main\PaymentIndex'; //8  --- class name of entity
    }



}
