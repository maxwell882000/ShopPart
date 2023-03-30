<?php

namespace App\Domain\Installment\Front\Admin\Files;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Main\MainCreditCreate;
use App\Domain\CreditProduct\Front\Main\MainCreditEdit;
use App\Domain\CreditProduct\Front\Main\MainCreditIndex;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Front\Main\TakenCreditCreate;
use App\Domain\Installment\Front\Main\TakenCreditEdit;
use App\Domain\Installment\Front\Main\TakenCreditShow;
use App\Domain\Installment\Front\Main\TakenCreditIndex;

class TakenCreditCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return TakenCredit::class;
    }

    public function getIndexEntity(): string
    {
        return TakenCreditIndex::class;
    }

    public function getCreateEntity(): string
    {
        return TakenCreditCreate::class;
    }

    public function getShowEntity(): string
    {
        return TakenCreditShow::class;
    }

    public function getEditEntity(): string
    {
        return  TakenCreditEdit::class;
    }
}
