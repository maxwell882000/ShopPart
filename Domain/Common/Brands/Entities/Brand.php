<?php

namespace App\Domain\Common\Brands\Entities;

use App\Domain\Common\Brands\Builders\BrandBuilder;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;
use App\Domain\Product\Product\Entities\Product;

class Brand extends Entity
{
    use MediaTrait;

    protected $table = "brands";

    public function newEloquentBuilder($query): BrandBuilder
    {
        return new BrandBuilder($query);
    }

    public function product()
    {
        return $this->hasMany(Product::class, "brand_id");
    }

    public function info(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BrandInfo::class, "id");
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $value);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function getMediaPathStorages(): string
    {
        return "brand/image";
    }

    public function mediaKeys(): array
    {
        return [
            'image'
        ];
    }
}
