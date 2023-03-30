<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\User\Services\PlasticCardService;

class OnlyPlasticCardService extends PlasticCardService
{
    protected function attach($object, $object_data)
    {
    }
}
