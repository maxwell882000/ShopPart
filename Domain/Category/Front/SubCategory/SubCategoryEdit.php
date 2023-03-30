<?php

namespace App\Domain\Category\Front\SubCategory;

use App\Domain\Category\Front\Main\CategoryEdit;

class SubCategoryEdit extends CategoryEdit
{
    public function additionalGeneration(): array
    {
        return [];
    }
}
