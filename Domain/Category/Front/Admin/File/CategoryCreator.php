<?php

namespace App\Domain\Category\Front\Admin\File;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Main\CategoryCreate;
use App\Domain\Category\Front\Main\CategoryEdit;
use App\Domain\Category\Front\Main\CategoryIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Core\File\Interfaces\CreatorInterface;
use App\Domain\Core\File\Models\FileBladeCreatorIndex;
use App\Domain\Core\File\Models\FileLivewireCreator;
use App\Domain\Core\File\Models\FileLivewireNested;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Traits\FastInstantiation;

class CategoryCreator extends MainFactoryCreator
{


    public function getEntityClass(): string
    {
        return Category::class;
    }

    public function getIndexEntity(): string
    {
        return CategoryIndex::class;
    }

    public function getCreateEntity(): string
    {
        return CategoryCreate::class;
    }

    public function getEditEntity(): string
    {
        return CategoryEdit::class;
    }
}
