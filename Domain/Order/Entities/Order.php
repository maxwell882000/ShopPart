<?php


namespace App\Domain\Order\Entities;


use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Location\Entities\Location;
use App\Domain\Order\Pivot\UserOrders;
use App\Domain\Product\Api\ProductBasket;
use App\Domain\User\Entities\User;

class Order extends Entity
{
    use Translatable;

    const FILLABLE = [
        'quantity',
        'order',
        'product_id',
        "price"
    ];
    public $guarded = null;
    public $timestamps = true;
    protected $fillable = self::FILLABLE;
    protected $table = "orders";
    protected $attributes = [
        'quantity' => 1,
        'order' => "{}",
    ];
    protected $casts = [
        'order' => 'json'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $savable = self::FILLABLE;
            if (count($savable) > 0) {
                $model->attributes = array_intersect_key($model->attributes, array_flip($savable));
            }
        });
    }

    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $this->appendToExisting('order', $value);
    }

    public function basket(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, "basket");
    }


    // not user checked if it is so
    public function userOrder(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, "users-order")
            ->using(UserOrders::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductBasket::class, "product_id");
    }

    public function locationOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class, 'order_id');
    }

    public function getOrderJsonAttribute(): ?string
    {
        return $this->getTranslatable('order-json');
    }

    public function setOrderJsonAttribute($value)
    {
        $this->setTranslate('order-json', $value);
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "product" => $this->product,
            "shop" => $this->product->shop,
        ];
    }
}
