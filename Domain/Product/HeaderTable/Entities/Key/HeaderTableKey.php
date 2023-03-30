<?php

namespace App\Domain\Product\HeaderTable\Entities\Key;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Entities\HeaderTable\Entities\HeaderTable;
use App\Domain\Product\Entities\HeaderText\Entitites\HeaderTextValueLink;
use App\Domain\Product\Entities\HeaderText\Entitites\HeaderTextValueText;

class HeaderTableKey extends Entity
{
    use Translatable;

    protected $table = 'key_texts';

    public function headerTableKeyText(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderTable::class);
    }
    public function keyTextValueText(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HeaderTextValueText::class);
    }
    public function keyTextValueLink(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HeaderTextValueLink::class);
    }

    public function setTextAttribute($value)
    {
        $this->setTranslate('text', $value);
    }

    public function getTextAttribute($value): ?string
    {
        return $this->getTranslatable('text');
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
