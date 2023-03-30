<?php

namespace App\Domain\Payment\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Payment\Entities\Payment;
use App\Domain\Payment\Front\Main\PaymentIndex;
use App\Domain\Payment\Front\Main\PaymentShow;

class PaymentCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Payment::class;
    }

    public function getIndexEntity(): string
    {
        return PaymentIndex::class;
    }

    public function getCreateEntity(): string
    {
        return "";
    }

    public function getEditEntity(): string
    {
        return "";
    }

    public function getShowEntity(): string
    {
        return PaymentShow::class;
    }
}
