<?php

namespace App\Domain\Currency\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Currency\Builders\CurrencyBuilder;

class Currency extends Entity
{
    protected $table = "currency";
    public function newEloquentBuilder($query)
    {
        return new CurrencyBuilder($query);
    }

}
