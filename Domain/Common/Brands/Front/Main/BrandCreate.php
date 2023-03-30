<?php

namespace App\Domain\Common\Brands\Front\Main;

use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class BrandCreate extends Brand implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::createAttribute("brand", "text", __("Название брэнда")),
            new InputFileTempAttribute("image", __("Лого"))
        ]);
    }
}
