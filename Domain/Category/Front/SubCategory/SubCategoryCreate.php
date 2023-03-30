<?php

namespace App\Domain\Category\Front\SubCategory;

use App\Domain\Category\Front\Main\CategoryCreate;

class SubCategoryCreate extends CategoryCreate
{
    public function additionalGeneration(): array
    {
        return [];
    }
}
