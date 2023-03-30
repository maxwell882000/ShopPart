<?php

namespace App\Domain\Category\Front\CategoryInHomeFront;

use App\Domain\Category\Front\Admin\DropDown\CategoryDropDownSearchFirst;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class CategoryInHomeCreate implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            CategoryDropDownSearchFirst::newCat(),
            InputAttribute::createAttribute("color", "color", 'Выберите цвет шрифта при наведение'),
            InputAttribute::createAttribute("back_color", "color", 'Выберите задний цвет при наведение'),
            InputAttribute::createAttribute("sort", "number", 'Порядок'),

        ]);
    }
}
