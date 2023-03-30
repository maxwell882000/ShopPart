<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;

class CardImage extends Entity
{
    use MediaTrait;

    public $incrementing = false;

    protected $primaryKey = "product_id";

    protected $table = "card_images";

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function getMediaPathStorages(): string
    {
        return "card/image";
    }

    public function getImageAttribute($value)
    {
        return $this->getMedia('image', $value);
    }


    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function mediaKeys(): array
    {
        return [
            "image"
        ];
    }
}
