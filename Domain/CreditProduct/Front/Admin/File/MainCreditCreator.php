<?php

namespace App\Domain\CreditProduct\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Main\MainCreditCreate;
use App\Domain\CreditProduct\Front\Main\MainCreditEdit;
use App\Domain\CreditProduct\Front\Main\MainCreditIndex;

class MainCreditCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return MainCredit::class;
    }

    public function getIndexEntity(): string
    {
        return MainCreditIndex::class;
    }

    public function getCreateEntity(): string
    {
        return MainCreditCreate::class;
    }

    public function getEditEntity(): string
    {
        return MainCreditEdit::class;
    }
}
