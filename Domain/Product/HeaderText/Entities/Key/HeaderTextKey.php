<?php

namespace App\Domain\Product\HeaderText\Entities\Key;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Entities\HeaderText\Entitites\HeaderText;
use App\Domain\Product\Entities\HeaderText\Entitites\HeaderTextValueLink;

class HeaderTextKey extends Entity
{
    use Translatable;

    protected $table = 'header_text_key_texts';


    public function headerTextKeyText(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HeaderText::class);
    }

    public function keyTextValueLink(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HeaderTextValueLink::class);
    }

    public function keyTextValueText(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HeaderTextValueLink::class);
    }

    public function setTextAttribute($value)
    {
        $this->setTranslate('text', $value);
    }

    public function getTextAttribute(): ?string
    {
        $this->getTranslatable('text');
    }

    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }

    public function livewireComponents(): array
    {
        // TODO: Implement livewireComponents() method.
    }

    public function getTableRows(): array
    {
        // TODO: Implement getTableRows() method.
    }
}
