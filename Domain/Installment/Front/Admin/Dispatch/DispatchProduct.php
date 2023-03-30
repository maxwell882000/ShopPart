<?php

namespace App\Domain\Installment\Front\Admin\Dispatch;

use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;
use App\Domain\Currency\Entities\Currency;
use App\Domain\Product\Product\Entities\Product;

class DispatchProduct extends Dispatch
{
    public static function run($object)
    {
        $overall_sum = 0;
        /**
         * $key ( id of the object ) => $value ( number of items chosen)
         */
        foreach ($object->entitiesStore as $key => $value) {
            $current = $value;
            $uzs_price = Product::find($key)->real_price;
            if (!($object->entitiesStore[$key] > 0)) {
                // if 0 was entered for number  of items choosen
                // it will set to 1
                $current = 1;
                $object->entitiesStore[$key] = $current;
            }
            $overall_sum = $uzs_price * $current + $overall_sum;
        }
        $object->dispatchBrowserEvent('product-update', ['sum' => $overall_sum]);
        $object->dispatchBrowserEvent('product-number', ['product' => json_encode($object->entitiesStore)]);
    }

}
