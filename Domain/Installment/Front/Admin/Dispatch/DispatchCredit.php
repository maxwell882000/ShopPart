<?php

namespace App\Domain\Installment\Front\Admin\Dispatch;

use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;
use App\Domain\CreditProduct\Entity\Credit;

class DispatchCredit extends Dispatch
{
    public static function run($object)
    {
        $credit = Credit::find($object->initial);
        $object->dispatchBrowserEvent('credit-update', ['month' => $credit->month, 'percent' => $credit->percent]);
    }
        public static function clear($object)
        {
            $object->dispatchBrowserEvent('credit-update', ['month' => 0, 'percent' => 0]);
        }
}
