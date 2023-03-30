<?php

namespace App\Domain\Product\Product\Front\Moderator\File;

use App\Domain\Core\File\Factory\MFCModerator;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Main\ProductCreate;
use App\Domain\Product\Product\Front\Main\ProductEdit;
use App\Domain\Product\Product\Front\Moderator\Pages\ModeratorProductIndex;

class ModeratorProductCreator extends MFCModerator
{
    public function getEntityClass(): string
    {
        return Product::class;
    }

    public function getIndexEntity(): string
    {
        return ModeratorProductIndex::class;
    }

    public function getCreateEntity(): string
    {
        return ProductCreate::class;
    }

    public function getEditEntity(): string
    {
        return ProductEdit::class;
    }
}
