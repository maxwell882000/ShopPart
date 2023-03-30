<?php

namespace App\Domain\Category\Front\Admin\File;

use App\Domain\Category\Front\All\AllCategory;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class CategoryAllCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return AllCategory::class;
    }

    public function getIndexEntity(): string
    {
        return AllCategory::class;
    }

    public function getCreateEntity(): string
    {
        return "";
    }

    public function getEditEntity(): string
    {
        return "";
    }
}
