<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Attributes;

use App\Domain\Installment\CustomInstallment\Front\Nested\CustomTransactionIndex;
use App\Domain\Installment\Front\Admin\Attributes\DescriptionAboutTransaction;

class CustomDescriptionAboutTransaction extends DescriptionAboutTransaction
{
    protected static function className()
    {
        return "CustomInstallmentShow";
    }

    static function classEntity()
    {
        return CustomTransactionIndex::class;
    }
}
