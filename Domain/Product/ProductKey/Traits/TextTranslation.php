<?php

namespace App\Domain\Product\ProductKey\Traits;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\ProductKey\Builders\ProductKeyBuilder;

trait TextTranslation
{
    use Translatable;


    public function attributesToArray()
    {
        $this->attributes['text_ru'] = $this->getTextRuAttribute();
//        $this->attributes['text_en'] = $this->getTextEnAttribute();
        $this->attributes['text_uz'] = $this->getTextUzAttribute();
        return $this->attributes;
    }

    public function getTextCurrentAttribute(): ?string
    {
        return $this->getTranslatable("text");
    }

    public function setTextAttribute($value)
    {
        $this->setTranslate('text', $value);
    }

    public function getTextAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("text");
    }

    public function getTextRuAttribute()
    {
        return $this->getTextAttribute()['ru'] ?? "";
    }

    public function getTextUzAttribute()
    {
        return $this->getTextAttribute()['uz'] ?? "";
    }

    public function getTextEnAttribute()
    {
        return $this->getTextAttribute()['en'] ?? "";
    }


    public function setTextRuAttribute($value)
    {
        $this->setTranslate("text", ["ru" => $value]);
    }

    public function setTextUzAttribute($value)
    {
        $this->setTranslate("text", ["uz" => $value]);
    }

    public function setTextEnAttribute($value)
    {
        $this->setTranslate("text", ["en" => $value]);
    }

    public static function getRules(): array
    {
        return [
            "text_ru" => "required",
            "text_uz" => "required",
//            "text_en" => "required",
        ];
    }
}
