<?php

namespace App\Domain\Delivery\Interfaces;

interface DeliveryStatus
{
    const CREATED = 0;
    const DELIVERY_PENDED = 10;
    const DELIVERED_NOT_PAID = 1;
    const DELIVERED_PAID = 2;

}
