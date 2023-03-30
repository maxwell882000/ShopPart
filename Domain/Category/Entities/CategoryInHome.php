<?php

namespace App\Domain\Category\Entities;

use App\Domain\Category\Api\CategoryView;
use App\Domain\Category\Builders\CategoryInHomeBuilder;
use App\Domain\Core\Main\Entities\Entity;

class CategoryInHome extends Entity
{
    protected $table = "category_in_home";
    protected $primaryKey = "category_id";
    public $incrementing = false;

    public function newEloquentBuilder($query): CategoryInHomeBuilder
    {
        return new CategoryInHomeBuilder($query);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CategoryView::class, 'category_id');
    }
}
