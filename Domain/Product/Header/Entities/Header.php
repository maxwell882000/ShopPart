<?php

namespace App\Domain\Product\Header\Entities;

use App\Domain\Core\Language\Traits\TextAttributeTranslatable;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\HeaderTable\Entities\HeaderTable;
use App\Domain\Product\Product\Entities\Product;


class Header extends Entity
{
    use TextAttributeTranslatable;

    protected $fillable = [
        "text"
    ];
    protected $guarded = null;
    protected $table = 'product_headers';

    public function body(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderBody::class, 'product_id');
    }


}
