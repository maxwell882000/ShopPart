<?php

namespace App\Domain\Product\Images\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;
use App\Domain\Product\Product\Entities\Product;

class Image extends Entity
{
    use MediaTrait;

    protected $table = 'images';

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia('image', $value, $this->id);
    }


    public function setImageAttribute($value)
    {
        $this->setMedia('image', $value, $this->id ?? 0);
    }

    public function getMediaPathStorages(): string
    {
        return "product/image";
    }

    public function mediaKeys(): array
    {
        return [
            "image"
        ];
    }
}

