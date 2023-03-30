<?php

namespace App\Domain\Product\Header\Entities;

use App\Domain\Core\Language\Traits\TextAttributeTranslatable;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;

class HeaderBody extends Entity
{
    use TextAttributeTranslatable;

    protected $table = 'product_header_bodies';

    public function header(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Header::class, 'product_header_id');
    }



}
