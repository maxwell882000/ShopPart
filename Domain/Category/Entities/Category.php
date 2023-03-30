<?php


namespace App\Domain\Category\Entities;


use App\Domain\Category\Builders\CategoryBuilder;
use App\Domain\Category\Interfaces\CategoryRelationInterface;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Models\Media;
use App\Domain\Core\Slug\Traits\Sluggable;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use Illuminate\Support\Collection;


class Category extends Entity implements CategoryRelationInterface
{
    use Translatable, Sluggable;

    public static function booted()
    {
        parent::booted();
        static::created(function ($model) {
            $model->order = $model->id;
            $model->save();
        });
    }

    protected $fillable = [
        'name',
        'status',
        'depth',
        'parent_id',
        'slug',
        'order',
        'depth',
        'is_important'
    ];
    protected $guarded = null;
    protected $table = "categories";

    public function newEloquentBuilder($query): CategoryBuilder
    {
        return new CategoryBuilder($query);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function deliveryImportant()
    {
        return $this->hasOne(DeliveryCategory::class, "id");
    }

    public function getNameAttribute($value): ?Collection
    {
        return $this->getTranslations("name");
    }

    public function filter(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FiltrationCategory::class, "category_id");
    }

    public function filterKey(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductKey::class,
            "filtration_key_category",
            "category_id",
            "product_key_id");
    }

    public function getNameCurrentAttribute(): ?string
    {
        return $this->getTranslatable('name');
    }

    public function setNameAttribute($value)
    {
        $this->setTranslate("name", $value);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function childsCategory()
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function icon()
    {
        return $this->hasOne(IconCat::class, "id");
    }

    public function getIconMediaAttribute(): Media
    {
        if ($this->icon) {
            return $this->icon->icon;
        }
        return new Media("", "", $this->id);
    }

    public function setIconMediaAttribute($value)
    {
        $icon = new IconCat();
        if ($this->icon) {
            $icon = $this->icon;
        } else {
            $icon->id = $this->id;
        }
        $icon->icon = $value;
        $icon->save();
    }

    public function slugSources(): array
    {
        return [
            "slug" => "name_current"
        ];
    }

}
