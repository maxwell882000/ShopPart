<?php

namespace App\Domain\Product\HeaderComponent\Header\Entities;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Entities\HeaderComponent\TextComponent\Entities\TextComponent;
use App\Domain\Product\Entities\Product;

class HeaderComponent extends Entity
{
    use Translatable;

    protected $table = 'header_components';

    public function headerComponent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function imageHeaderComponent(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ImageComponent::class, 'header_component_id');
    }

    public function headerTextComponent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TextComponent::class, 'id');
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

