<?php

namespace App\Domain\Currency\Traits;

use App\Domain\Currency\Entities\Currency;

trait ConvertToSum
{
    public $currencyEntity;

    public function convertToSum($price)
    {
        if (!$this->currencyEntity) {
            $this->currencyEntity = Currency::last();
        }
        return Currency::last()->price * $price;
    }
}
