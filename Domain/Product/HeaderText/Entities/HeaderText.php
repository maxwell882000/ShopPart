<?php

namespace App\Domain\Product\HeaderText\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\ProductKey\Traits\TextTranslation;

class HeaderText extends Entity
{
    use TextTranslation;

    protected $guarded = null;
    protected $fillable = [
        "text",
        "text_ru",
        "text_uz",
        "text_en",
    ];
    protected $table = "header_texts";

}
