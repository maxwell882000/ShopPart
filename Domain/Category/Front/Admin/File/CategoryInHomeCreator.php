<?php

namespace App\Domain\Category\Front\Admin\File;

use App\Domain\Category\Entities\CategoryInHome;
use App\Domain\Category\Front\CategoryInHomeFront\CategoryInHomeCreate;
use App\Domain\Category\Front\CategoryInHomeFront\CategoryInHomeEdit;
use App\Domain\Category\Front\CategoryInHomeFront\CategoryInHomeIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class CategoryInHomeCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return CategoryInHome::class;
    }

    public function getIndexEntity(): string
    {
        return CategoryInHomeIndex::class;
    }

    public function getCreateEntity(): string
    {
        return CategoryInHomeCreate::class;
    }

    public function getEditEntity(): string
    {
        return CategoryInHomeEdit::class;
    }
}
