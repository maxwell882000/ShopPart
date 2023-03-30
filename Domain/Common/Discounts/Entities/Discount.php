<?php

namespace App\Domain\Common\Discounts\Entities;

use App\Domain\Common\Discounts\Builders\DiscountBuilder;
use App\Domain\Common\Discounts\Interfaces\DiscountRelation;
use App\Domain\Core\Front\Admin\Form\Traits\AttachNested;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTraitTranslatable;
use App\Domain\Product\Product\Entities\Product;

class Discount extends Entity implements DiscountRelation
{
    use MediaTraitTranslatable, AttachNested;

    protected $table = "discounts";

    public function product()
    {
        return $this->belongsToMany(
            Product::class,
            "discount_product",
            "discount_id",
            "product_id");
    }

    public function acceptProduct($id)
    {
        $this->attachedManyNested($id, self::PRODUCT_SERVICE);
    }

    public function newEloquentBuilder($query): DiscountBuilder
    {
        return new DiscountBuilder($query);
    }

    public function getMediaPathStorages(): string
    {
        return "discounts/media";
    }

    public function getDesImageRuAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("des_image", $this->des_image['ru']);
    }

    public function getDesImageUzAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("des_image", $this->des_image['uz']);
    }

    public function getDesImageEnAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("des_image", $this->des_image['en']);
    }

    public function setDesImageAttribute($value)
    {
        $this->setMedia("des_image", $value, $this->id);
    }

    public function getDesImageAttribute($value)
    {
        return $this->getTranslations("des_image");
    }

    public function getDesImageCurrentAttribute()
    {
        return $this->getMedia("des_image", $this->getTranslatable("des_image"));
    }

    public function getMobImageCurrentAttribute()
    {
        return $this->getMedia("mob_image", $this->getTranslatable("mob_image"));
    }

    public function getMobImageAttribute($value)
    {
        return $this->getTranslations("mob_image");
    }

    public function getMobImageRuAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("mob_image", $this->mob_image['ru']);
    }

    public function getMobImageUzAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("mob_image", $this->mob_image['uz']);
    }

    public function getMobImageEnAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("mob_image", $this->mob_image['en']);
    }

    public function setMobImageAttribute($value)
    {

        $this->setMedia("mob_image", $value, $this->id);
    }

    public function mediaKeys(): array
    {
        return [
            'des_image',
            'mob_image'
        ];
    }
}
