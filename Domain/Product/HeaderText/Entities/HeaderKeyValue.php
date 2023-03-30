<?php

namespace App\Domain\Product\HeaderText\Entities;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\HeaderText\Builders\HeaderKeyValueBuilder;

class HeaderKeyValue extends Entity
{
    use Translatable;

    protected $guarded = null;
    protected $fillable = [
        'key',
        'header_product_id',
        'value'
    ];
    protected $table = "header_key_value";

    public function newEloquentBuilder($query)
    {
        return new HeaderKeyValueBuilder($query);
    }

    public function getValueAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("value");
    }

    public function getKeyAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("key");
    }

    public function getKeyCurrentAttribute()
    {
        return $this->getTranslatable("key");
    }

    public function getValueCurrentAttribute()
    {
        return $this->getTranslatable("value");
    }

    public function setKeyAttribute($value)
    {
        $this->setTranslate("key", $value);
    }

    public function setValueAttribute($value)
    {
        $this->setTranslate("value", $value);
    }

    public static function getRules(): array
    {
        return [
            "key_ru" => "required",
//            "key_en" => "required",
            "key_uz" => "required",
            "value_ru" => "required",
//            "value_en" => "required",
            "value_uz" => "required",
        ];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            "key" => $this->key_current,
            "value" => $this->value_current
        ];
    }
}
