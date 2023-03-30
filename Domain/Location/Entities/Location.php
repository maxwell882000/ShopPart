<?php


namespace App\Domain\Location\Entities;


use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Order\Entities\Order;
use App\Domain\User\Entities\User;

class Location extends Entity
{
    protected $table = 'locations';

    public function userLocation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class);
    }
    public function location(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Order::class);
    }

}
