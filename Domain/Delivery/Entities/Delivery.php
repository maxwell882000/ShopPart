<?php

namespace App\Domain\Delivery\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Order\Entities\UserPurchase;

/**
 * is it possible to connect several
 * products to one delivery
 * if it is possible there is the method how i can make this
 * formula user_purchase_id + shop_address_id
 *
 * All status will be observed , so when all will be delivered , overall status will be delivered
 *
 * So there could be several status:
 * First about delivery
 * Second about payment
 */
class Delivery extends Entity
{
    protected $table = 'delivery';
    protected $guarded = null;
    protected $fillable = [
        "user_purchase_id",
        "shop_address_id",
        "orderNum",
        "datePickup",
        'status',
    ];

    public function userPurchase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserPurchase::class, 'user_purchase_id');
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(InvoiceFile::class, "id");
    }

    public function status()
    {

    }
}
