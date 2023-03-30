<?php

namespace App\Domain\Payment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Payment\Entities\PaymentCard;

class PaymentCardService extends BaseService
{
    public function getEntity(): Entity
    {
        return new PaymentCard();
    }
}
