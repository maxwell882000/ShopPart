<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Files;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Main\CustomInstallmentCreate;
use App\Domain\Installment\CustomInstallment\Front\Main\CustomInstallmentIndex;
use App\Domain\Installment\CustomInstallment\Front\Main\CustomInstallmentShow;

class CustomInstallmentCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return CustomInstallment::class;
    }

    public function getIndexEntity(): string
    {
        return CustomInstallmentIndex::class;
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
        return CustomInstallmentShow::class;
    }

    public function getCreateNextEntity(): string
    {
        return CustomInstallmentCreate::class;
    }
}
