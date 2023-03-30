<?php

namespace App\Domain\Lenta\Entities;

use App\Domain\Core\Front\Admin\Form\Traits\AttachNested;
use App\Domain\Core\Language\Traits\TextAttributeTranslatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTraitTranslatable;
use App\Domain\Lenta\Builders\LentaBuilder;
use App\Domain\Lenta\Interfaces\LentaInterface;
use App\Domain\Product\Product\Entities\Product;
use Illuminate\Support\Collection;

class Lenta extends Entity implements LentaInterface
{
    use TextAttributeTranslatable, AttachNested, MediaTraitTranslatable;

    const PRODUCT_CLASS = Product::class;
    protected $table = 'lenta';
    public $timestamps = true;

    public function newEloquentBuilder($query)
    {
        return new LentaBuilder($query);
    }


    public function getTextAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations('text');
    }

    public function getTextCurrentAttribute(): ?string
    {
        return $this->getTranslatable("text");
    }

    public function product()
    {
        return $this->belongsToMany(static::PRODUCT_CLASS,
            "lenta_product",
            'lenta_id',
            'product_id'
        );
    }

    public function productAccept($id, $status)
    {
        $this->attachedManyNested($id, self::PRODUCT_SERVICE);
    }

    public function getMediaPathStorages()
    {
        return "lenta/image";
    }

    public function getLeftImageAttribute(): ?Collection
    {
        return $this->getTranslations("left_image");
    }

    public function getLeftImageCurrentAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("left_image", $this->getTranslatable("left_image"));
    }

    public function getLeftImageRuAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("left_image", $this->left_image['ru'] ?? "");
    }

    public function getLeftImageUzAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("left_image", $this->left_image['uz'] ?? "");
    }

//    public function getLeftImageEnAttribute(): \App\Domain\Core\Media\Models\Media
//    {
//        return $this->getMedia("left_image", $this->left_image['en'] ?? "");
//    }


    public function setLeftImageAttribute($value)
    {
//        dd($value);
        $this->setMedia("left_image", $value, $this->id);
    }

    public function mediaKeys(): array
    {
        return [
            'left_image',
        ];
    }

}
