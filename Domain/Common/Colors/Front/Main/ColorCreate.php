<?php

namespace App\Domain\Common\Colors\Front\Main;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class ColorCreate extends Color implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("color", __("Введите цвета")),
            InputAttribute::createAttribute("color_hex", "color", 'Выберите цвет')
        ]);
    }
}
