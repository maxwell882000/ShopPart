<?php

namespace App\Domain\Payment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Payment\Builders\PaymentBuilder;
use App\Domain\Payment\Interfaces\PaymentAction;
use App\Domain\Payment\Interfaces\PaymentRelation;
use App\Domain\Payment\Traits\PaymentStatusTrait;
use App\Domain\User\Traits\HasUserRelationship;

class Payment extends Entity implements PaymentRelation, PaymentAction
{
    use HasUserRelationship, PaymentStatusTrait, HasPrice;

    protected $table = "payments";
    public $timestamps = true;

    public function newEloquentBuilder($query): PaymentBuilder
    {
        return new PaymentBuilder($query);
    }

    public function purchase()
    {
        return $this->belongsTo(UserPurchase::class, "purchase_id");
    }

    public function card()
    {
        return $this->hasOne(PaymentCard::class, "payment_id");
    }

    public function reason()
    {
        return $this->hasOne(PaymentError::class, "id");
    }

    public function saveAccept()
    {
        $this->status = self::ACCEPTED;
        $this->accepted_at = now();
        $this->save();
    }
}
