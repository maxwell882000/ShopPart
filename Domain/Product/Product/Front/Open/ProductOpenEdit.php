<?php

namespace App\Domain\Product\Product\Front\Open;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class ProductOpenEdit extends Category implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([

        ]);
    }
}
