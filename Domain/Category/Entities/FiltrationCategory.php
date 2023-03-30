<?php

namespace App\Domain\Category\Entities;

use App\Domain\Category\Builders\FiltrationCategoryBuilder;
use App\Domain\Category\Front\Admin\DropDown\FiltrationCategoryDropDown;
use App\Domain\Category\Interfaces\FiltrationInterface;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Main\Entities\Entity;
// can be depreciated
// not used , but might be used
class   FiltrationCategory extends Entity implements FiltrationInterface
{
    protected $table = "filtration_category";
    protected $guarded = ['id'];

    public function newEloquentBuilder($query): FiltrationCategoryBuilder
    {
        return new FiltrationCategoryBuilder($query);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public static function getRules(): array
    {
        return [
            'key' => "required",
            'attribute' => 'required',
        ];
    }

}
