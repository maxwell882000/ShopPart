<?php

namespace App\Domain\Payment\Interfaces;

interface PaymentAction
{
    public function saveAccept(); // when we accept we have to deal with the quantity of the products
}
