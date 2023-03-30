<?php

namespace App\Domain\Order\Pivot;

use App\Domain\Core\Main\Traits\StatusCheck;
use App\Domain\Order\Entities\Order;
use App\Domain\Order\Interfaces\UserOrderInterface;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserOrders extends Pivot implements UserOrderInterface
{
    use StatusCheck;

    protected $table = 'users_order';

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function getIsCashAttribute(): bool
    {
        return $this->getStatus($this->status, self::CASH);
    }

    public function getIsInstancePaymentAttribute(): bool
    {
        return $this->getStatus($this->status, self::INSTANCE_PAYMENT);
    }

    public function getIsInstallmentAttribute(): bool
    {
        return $this->getStatus($this->status, self::INSTALMENT);
    }

    public function setStatusAttribute($value)
    {
        $this->setStatus("status", $value);
    }
}
