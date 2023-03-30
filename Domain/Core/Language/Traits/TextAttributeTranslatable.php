<?php

namespace App\Domain\Core\Language\Traits;

trait TextAttributeTranslatable
{
    use Translatable;

    public function setTextAttribute($value)
    {
        $this->setTranslate('text', $value);
    }

    public function getTextAttribute(): ?string
    {
        return $this->getTranslatable('text');
    }


}
