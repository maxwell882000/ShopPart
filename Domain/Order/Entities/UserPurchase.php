<?php

namespace App\Domain\Order\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\UuidKey\Traits\HasUniqueId;
use App\Domain\Delivery\Entities\DeliveryAddress;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Order\Builders\UserPurchaseBuilder;
use App\Domain\Order\Interfaces\UserPurchaseRelation;
use App\Domain\Order\Traits\HasQuantityChecker;
use App\Domain\Order\Traits\UserPurchaseDelivery;
use App\Domain\Order\Traits\UserPurchaseStatus;
use App\Domain\Payment\Entities\Payment;
use App\Domain\User\Traits\HasUserRelationship;

class UserPurchase extends Entity implements UserPurchaseRelation
{
    use HasUniqueId, HasUserRelationship,
        UserPurchaseStatus,
        UserPurchaseDelivery, HasQuantityChecker;

    protected $table = "user_purchases";
    protected $fillable = [
        'user_id',
        'status'
    ];
    protected $guarded = null;
    public $timestamps = true;

    public function saveAccept()
    {
        $this->checkOnQuantity();
    }

    public function newEloquentBuilder($query)
    {
        return new UserPurchaseBuilder($query);
    }

    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Purchase::class, "user_purchase_id");
    }

    /**
     *  real price considering discount at the moment of purchase
     * **/
    public function sumPurchases()
    {
        return $this->purchases()->sum("price");
    }

    public function sumPurchasesShow()
    {
        return $this->formatPrice($this->sumPurchases());
    }

    public function getNumberPurchaseAttribute(): int
    {
        return $this->purchases()->sum("quantity");
    }


    public function payble()
    {
        if ($this->isInstallment() || $this->takenCredit()->exists()) {
            return $this->takenCredit;
        } else if ($this->isInstansPayment() || $this->payment()->exists()) {
            return $this->payment;
        }
        throw new \Exception(sprintf("Отсутствует тип платежа. Номер в системе: %s ", $this->id));
    }

    // mutually exclusive takenCredit and payment
    public function takenCredit()
    {
        return $this->hasOne(TakenCredit::class, "purchase_id");
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, "purchase_id");
    }

    public function typePayment()
    {
        return self::TYPE_OF_PURCHASE[$this->getPayment()];
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DeliveryAddress::class, "purchase_address",
            "user_purchase_id",
            "delivery_address_id");
    }

    public function getDeliveryAddressAttribute(): DeliveryAddress
    {
        return $this->address()->first();
    }

    // write it fully
    public function titlesOfPurchases()
    {
        return $this->purchases()->with("products");
    }
}
