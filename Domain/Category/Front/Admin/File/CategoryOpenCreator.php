<?php

namespace App\Domain\Category\Front\Admin\File;

use App\Domain\Category\Front\SubCategory\SubCategory;
use App\Domain\Category\Front\SubCategory\SubCategoryCreate;
use App\Domain\Category\Front\SubCategory\SubCategoryEdit;
use App\Domain\Core\File\Factory\MainOpenFactoryCreator;

class CategoryOpenCreator extends MainOpenFactoryCreator
{

    public function getEntityClass(): string
    {
        return SubCategory::class;
    }

    public function getIndexEntity(): string
    {
        return SubCategory::class;
    }

    public function getCreateEntity(): string
    {
        return SubCategoryCreate::class;
    }

    public function getEditEntity(): string
    {
        return SubCategoryEdit::class;
    }
}
