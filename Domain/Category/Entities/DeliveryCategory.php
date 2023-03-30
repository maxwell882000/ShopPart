<?php

namespace App\Domain\Category\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\CheckedAttribute;

class DeliveryCategory extends Entity
{
    use CheckedAttribute;

    public $incrementing = false;
    protected $table = "delivery_categories";

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, "id");
    }
}
