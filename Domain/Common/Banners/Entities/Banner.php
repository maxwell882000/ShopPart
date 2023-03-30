<?php

namespace App\Domain\Common\Banners\Entities;

use App\Domain\Common\Banners\Builders\BannerBuilder;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTraitTranslatable;
use Illuminate\Support\Collection;

class Banner extends Entity
{
    use MediaTraitTranslatable;

    protected $table = "main_banner";
    protected $fillable = [
        'link',
        'image',
        'image_mobile'
    ];
    protected $guarded = null;

    public function newEloquentBuilder($query)
    {
        return new BannerBuilder($query);
    }

    public function getMediaPathStorages()
    {
        return "banner/image";
    }

    public function getImageAttribute(): ?Collection
    {
        return $this->getTranslations("image");
    }

    public function getImageMobileAttribute(): ?Collection
    {
        return $this->getTranslations("image_mobile");
    }

    public function getImageCurrentAttribute()
    {
        return $this->getMedia("image", $this->getTranslatable("image"));
    }

    public function getImageMobileCurrentAttribute()
    {
        return $this->getMedia("image_mobile", $this->getTranslatable("image_mobile"));
    }

    public function getImageMobileRuAttribute()
    {

        return $this->getMedia("image_mobile", $this->image_mobile['ru'] ?? "");
    }

    public function getImageMobileUzAttribute()
    {
        return $this->getMedia("image_mobile", $this->image_mobile['uz'] ?? "");
    }

    public function getImageMobileEnAttribute()
    {
        return $this->getMedia("image_mobile", $this->image_mobile['en'] ?? "");
    }

    public function getImageRuAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $this->image['ru']);
    }

    public function getImageUzAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $this->image['uz']);
    }

    public function getImageEnAttribute(): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $this->image['en']);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function setImageMobileAttribute($value)
    {
        $this->setMedia("image_mobile", $value, $this->id);
    }

    public function mediaKeys(): array
    {
        return [
            'image',
            "image_mobile"
        ];
    }

    public static function getCreateRules(): array
    {
        return [

        ];
    }

    public static function getUpdateRules(): array
    {
        return parent::getUpdateRules();
    }


}
