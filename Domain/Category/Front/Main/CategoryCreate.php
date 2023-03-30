<?php

namespace App\Domain\Category\Front\Main;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Dynamic\FiltrationKeyCategoryDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class CategoryCreate extends Category implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("name", __("Введите  имя категории")),
            new InputFileTempAttribute(
                self::CATEGORY_ICON_DATA,
                "Загрузите иконку",
            ),
            new InputFileTempAttribute(
                self::CATEGORY_ICON_TO . "image",
                "Загрузите картинку",
            ),
            FiltrationKeyCategoryDynamicWithoutEntity::getDynamic("CategoryCreate"),
            ...$this->additionalGeneration()
        ]);
    }

    public function additionalGeneration(): array
    {
        return [
            InputAttribute::createAttribute(self::DELIVERY_IMPORTANT_TO, "checkbox", "Ценный груз")
        ];
    }
}
