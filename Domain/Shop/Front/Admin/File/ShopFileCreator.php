<?php

namespace App\Domain\Shop\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Front\Main\ShopCreate;
use App\Domain\Shop\Front\Main\ShopEdit;
use App\Domain\Shop\Front\Main\ShopIndex;

class ShopFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Shop::class;
    }

    public function getIndexEntity(): string
    {
        return ShopIndex::class;
    }

    public function getCreateEntity(): string
    {
        return ShopCreate::class;
    }

    public function getEditEntity(): string
    {
        return ShopEdit::class;
    }
}
