<?php

namespace App\Domain\Core\File\Factory;

use App\Domain\Core\File\Models\Shop\FBCShopCreate;
use App\Domain\Core\File\Models\Shop\FBCShopCreateNext;
use App\Domain\Core\File\Models\Shop\FBCShopEdit;
use App\Domain\Core\File\Models\Shop\FBCShopIndex;
use App\Domain\Core\File\Models\Shop\FBCShopShow;

abstract class MFCShop extends MainFactoryCreator
{
    protected function getIndexBladeCreator(): string
    {
        return FBCShopIndex::class;
    }

    protected function getEditBladeCreator(): string
    {
        return FBCShopEdit::class;
    }

    protected function getCreateBladeCreator(): string
    {
        return FBCShopCreate::class;
    }

    protected function getShowBladeCreator(): string
    {
        return FBCShopShow::class;
    }

    protected function getCreateNextBladeCreator(): string
    {
        return FBCShopCreateNext::class;
    }
}
