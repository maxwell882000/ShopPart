<?php

namespace App\Domain\Delivery\Entities;

use App\Domain\Core\Main\Entities\Entity;

class InvoiceFile extends Entity
{
    public $incrementing = false;

    public function delivery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delivery::class, "id");
    }
}
