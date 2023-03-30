<?php

namespace App\Domain\Product\HeaderText\Pivot;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\HeaderText\Entities\HeaderKeyValue;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HeaderProduct extends Pivot
{
    protected $table = "header_product";
    public $incrementing = true;
    public $timestamps = false;

    public function keyValue()
    {
        return $this->hasMany(
            HeaderKeyValue::class,
            "header_product_id");
    }

    public function toArray()
    {
        return $this->keyValue->toArray();
    }
}
