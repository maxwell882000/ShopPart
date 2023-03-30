<?php

namespace App\Domain\Product\Product\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Main\ProductCreate;
use App\Domain\Product\Product\Front\Main\ProductEdit;
use App\Domain\Product\Product\Front\Main\ProductIndex;

class ProductCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Product::class;
    }

    public function getIndexEntity(): string
    {
        return ProductIndex::class;
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
