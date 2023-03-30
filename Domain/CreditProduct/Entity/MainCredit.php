<?php

namespace App\Domain\CreditProduct\Entity;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\CreditProduct\Builders\MainCreditBuilder;
use Illuminate\Support\Collection;

class MainCredit extends Entity
{
    use Translatable;

    protected $table = "main_credits";

    public function getNameAttribute(): ?Collection
    {
        return $this->getTranslations("name");
    }

    public function setNameAttribute($value)
    {
        $this->setTranslate("name", $value);
    }

    public function getNameCurrentAttribute(): ?string
    {
        return $this->getTranslatable("name");
    }


    public function getHelperTextAttribute(): ?Collection
    {
        return $this->getTranslations("helper_text");
    }

    public function setHelperTextAttribute($value)
    {
        $this->setTranslate("helper_text", $value);
    }

    public function getHelperTextCurrentAttribute(): ?string
    {
        return $this->getTranslatable("helper_text");
    }

    public function newEloquentBuilder($query)
    {
        return MainCreditBuilder::new($query);
    }

    public function credits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Credit::class, "main_credit_id");
    }

    // for product card to show
    public function lastCredit()
    {
        return $this->credits()->orderBy("month", "DESC")->first();
    }

    static public function getRules(): array
    {
        return [
            "name" => "required",
            "helper_text" => "required",
            "initial_percent" => "required|numeric"
        ];
    }
}
