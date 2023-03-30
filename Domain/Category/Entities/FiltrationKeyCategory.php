<?php

namespace App\Domain\Category\Entities;

use App\Domain\Category\Builders\FiltrationKeyCategoryBuilder;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;

class FiltrationKeyCategory extends Entity
{
    use Translatable;
    protected $guarded = null;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);


    }
    public function attributesToArray(){
        $this->attributes['key_ru'] = $this->getKeyRuAttribute();
        $this->attributes['key_en'] = $this->getKeyEnAttribute();
        $this->attributes['key_uz'] = $this->getKeyUzAttribute();
        return $this->attributes;
    }
    protected $fillable = [
      'key_ru',
      'key_en',
      'key_uz',
      'category_id'
    ];
    protected $table = "filtration_key_category";

    public function newEloquentBuilder($query)
    {
        return new FiltrationKeyCategoryBuilder($query);
    }

    public function getKeyAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("key");
    }

    public function getKeyRuAttribute()
    {
        return $this->getKeyAttribute()['ru'] ?? "";
    }

    public function getKeyUzAttribute()
    {
        return $this->getKeyAttribute()['uz'] ?? "";
    }

    public function getKeyEnAttribute()
    {
        return $this->getKeyAttribute()['en'] ?? "";
    }

    public function setKeyAttribute($value)
    {
        $this->setTranslate("key", $value);
    }

    public function setKeyRuAttribute($value)
    {
        $this->setTranslate("key", ["ru" => $value]);
    }

    public function setKeyUzAttribute($value)
    {
        $this->setTranslate("key", ["uz" => $value]);
    }

    public function setKeyEnAttribute($value)
    {
        $this->setTranslate("key", ["en" => $value]);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public static function getRules(): array
    {
        return [
            "key_ru" => "required",
            "key_uz" => "required",
            "key_en" => "required",
        ];
    }
}
