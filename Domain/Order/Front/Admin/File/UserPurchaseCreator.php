<?php

namespace App\Domain\Order\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Order\Front\Main\UserPurchaseIndex;

class UserPurchaseCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return UserPurchase::class;
    }

    public function getIndexEntity(): string
    {
        return UserPurchaseIndex::class;
    }

    public function getCreateEntity(): string
    {
        return "";
    }

    public function getEditEntity(): string
    {
        return '';
    }
}
