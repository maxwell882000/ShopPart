<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Category\Entities\Category;
use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Core\Front\Admin\File\Attributes\FilesAttributes;
use App\Domain\Core\Front\Admin\Form\Traits\AttachNested;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Core\Media\Traits\MediaManyTrait;
use App\Domain\Core\Slug\Traits\Sluggable;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\Currency\Traits\ConvertToSum;
use App\Domain\Product\Color\Entities\ProductMainColor;
use App\Domain\Product\Header\Entities\HeaderBody;
use App\Domain\Product\HeaderComponent\Header\Entities\HeaderComponent;
use App\Domain\Product\HeaderTable\Entities\HeaderTable;
use App\Domain\Product\HeaderText\Entities\HeaderText;
use App\Domain\Product\HeaderText\Pivot\HeaderProduct;
use App\Domain\Product\Images\Entities\Image;
use App\Domain\Product\Product\Builders\ProductBuilder;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\Product\Logic\ProductLogic;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use App\Domain\Product\ProductKey\Pivot\ProductKeyProducts;
use App\Domain\Shop\Entities\Shop;
use App\Domain\User\Entities\User;
use ProductStats;

class Product extends Entity implements ProductInterface
{
    use Translatable, Sluggable, MediaManyTrait, ConvertToSum, AttachNested, HasPrice;

    protected $table = "products";
    protected ProductLogic $productLogic;
    public $timestamps = true;

    public static function getCreateRules(): array
    {
        return [
            "title" => "required",
            "price" => "required",
            "currency" => "required",
            "number" => "required",
            "weight" => "required",
            "category_id" => "required",
            "shop_id" => "required",
            "brand_id" => "required"
        ];
    }

    public static function getValidationMessage(): array
    {
        return [
            'percentage.integer' => __("Добавьте скиди или укажите 0")
        ];
    }

    public static function getUpdateRules(): array
    {
        return [
            'percentage' => "integer|max:99"
        ];
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->productLogic = new ProductLogic($this);
    }

    public function newInstance($attributes = [], $exists = false)
    {
        $this->productLogic = new ProductLogic($this);
        return parent::newInstance($attributes, $exists);
    }
    // характеристики
    // header
    // key ... value
    // key ... value
    // ...
    public function comment()
    {
        return $this->belongsToMany(User::class,
            "comment_product",
            "product_id",
            "user_id")->withPivot(['status', "message", "created_at"]);
    }

    public function mark()
    {
        return $this->belongsToMany(User::class,
            "mark_product",
            "product_id",
            "user_id"
        )->withPivot("mark");
    }

    public function info()
    {
        return $this->hasOne(ProductInfo::class, "id");
    }

    public function headerText()
    {
        return $this->belongsToMany(HeaderText::class,
            "header_product",
            "product_id",
            'header_text_id'
        )->using(HeaderProduct::class)->withPivot(["id"]);
    }

    public function getLogic(): ProductLogic
    {
        return $this->productLogic;
    }

    public
    function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }

    public function colors()
    {
        return $this->hasMany(ProductMainColor::class, "product_id");
    }

    public
    function description(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductDescription::class, "product_id");
    }

    public
    function bodies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderBody::class, "product_id");
    }

    public
    function getBodyFirstAttribute()
    {
        return $this->bodies()->first()->header;
    }

    public
    function shop()
    {
        return $this->belongsTo(Shop::class, "shop_id");
    }

    public
    function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public
    function user_favourites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, "favourites");
    }

    public
    function discounts()
    {
        return $this->belongsToMany(Discount::class,
            "discount_product",
            "product_id",
            "discount_id");
    }

    public
    function acceptMainCredit($id, $status)
    {
        $this->attachedManyNested($id, self::MAIN_CREDIT_SERVICE);
    }

    public
    function setProductOfDayAttribute($value)
    {
        $this->productDay()->attach($value);
    }

    public
    function productDay()
    {
        return $this->hasOne(ProductOfDay::class, "product_id");
    }

    public function mainCredit()
    {
        return $this->belongsToMany(MainCredit::class,
            "product_credits",
            "product_id",
            "main_credit_id"
        );
    }

    public
    function productProductStatus()
    {
        return $this->belongsToMany(ProductStats::class);
    }

    public
    function productImage(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public
    function productImageHeader(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CardImage::class, 'product_id');
    }

    public
    function getRealPriceAttribute()
    {
        return $this->productLogic->getPrice();
    }

    public
    function productProductInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductInfo::class, 'product_id');
    }

    public
    function productKey(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductKey::class,
            'product_keys_product',
            'product_id',
            'products_key_id')->using(ProductKeyProducts::class)->withPivot("id");
    }

    public
    function productHeaderText(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderText::class, 'product_id');
    }

    public
    function productHeaderTable(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderTable::class, 'product_id');
    }

    public
    function productHeaderComponent(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeaderComponent::class, 'product_id');
    }


    public
    function productHit()
    {
        return $this->hasOne(ProductHit::class, "product_id");
    }

    public
    function setTitleAttribute($value)
    {
        $this->setTranslate('title', $value);
    }

    public
    function getTitleAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations('title');
    }

    public
    function getTitleCurrentAttribute(): ?string
    {
        return $this->getTranslatable('title');
    }


    public
    function slugSources(): array
    {
        return [
            'slug' => 'title_current'
        ];
    }

    public
    function getImagesAttribute()
    {
        return $this->getManyMedia("productImage", "image");
    }

    public
    function setImagesAttribute($value)
    {
        $this->setSaveManyMedia("productImage", $value, "image");
    }

    /*
     *  it is being here to reduce amount of work to do
     *  the upload function is used in the service
     * **/
    public
    function getImageProductAttribute(): FilesAttributes
    {
        return new FilesAttributes($this,
            "images",
            "product_1",
            Image::class,
            "image",
            "product_id");
    }

}

