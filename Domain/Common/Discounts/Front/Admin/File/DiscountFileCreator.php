<?php

namespace App\Domain\Common\Discounts\Front\Admin\File;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Common\Discounts\Front\Main\DiscountCreate;
use App\Domain\Common\Discounts\Front\Main\DiscountEdit;
use App\Domain\Common\Discounts\Front\Main\DiscountIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class DiscountFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Discount::class;
    }

    public function getIndexEntity(): string
    {
        return DiscountIndex::class;
    }

    public function getCreateEntity(): string
    {
        return DiscountCreate::class;
    }

    public function getEditEntity(): string
    {
        return DiscountEdit::class;
    }
}
