<?php

namespace App\Domain\Payment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\User\Entities\PlasticCard;

class PaymentCard extends Entity
{
    protected $table = "payment_card";

    public $incrementing = false;
    protected $guarded = null;
    protected $fillable = [
        "payment_id",
        'plastic_id',
        'transaction_id'
    ];
    protected $primaryKey = "payment_id";

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class, "payment_id");
    }

    public function plastic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PlasticCard::class, "plastic_id");
    }
}
