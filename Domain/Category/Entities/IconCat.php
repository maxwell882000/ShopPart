<?php


namespace App\Domain\Category\Entities;


use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;

class IconCat extends Entity
{
    use MediaTrait;

    protected $table = "icon_cats";
    public $incrementing = false;

    public function getIconAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("icon", $value);
    }

    public function setIconAttribute($value)
    {
        $this->setMedia("icon", $value, $this->category_id);
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $value);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->category_id);
    }


    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'id');
    }

    public function getMediaPathStorages(): string
    {
        return "category/super_icon";
    }

    public function mediaKeys(): array
    {
        return [
            "icon",
            "image"
        ];
    }
}
