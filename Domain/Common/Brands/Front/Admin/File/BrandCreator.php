<?php

namespace App\Domain\Common\Brands\Front\Admin\File;

use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Common\Brands\Front\Main\BrandCreate;
use App\Domain\Common\Brands\Front\Main\BrandEdit;
use App\Domain\Common\Brands\Front\Main\BrandIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class BrandCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Brand::class;
    }

    public function getIndexEntity(): string
    {
        return BrandIndex::class;
    }

    public function getCreateEntity(): string
    {
        return BrandCreate::class;
    }

    public function getEditEntity(): string
    {
        return BrandEdit::class;
    }
}
