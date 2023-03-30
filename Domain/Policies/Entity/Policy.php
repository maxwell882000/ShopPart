<?php

namespace App\Domain\Policies\Entity;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Policies\Builder\PolicyBuilder;

class Policy extends Entity
{
    use Translatable;

    protected $table = "policies";
    public $timestamps = true;

    public function newEloquentBuilder($query)
    {
        return new PolicyBuilder($query);
    }

    public function getPoliciesAttribute()
    {
        return $this->getTranslations("policies");
    }

    public function setPoliciesAttribute($value)
    {
        $this->setTranslate("policies", $value);
    }

    public function getPolicyAttribute(): ?string
    {
        return $this->getTranslatable("policies");
    }
}
