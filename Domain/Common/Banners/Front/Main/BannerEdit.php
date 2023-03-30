<?php

namespace App\Domain\Common\Banners\Front\Main;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

//*
// cannot change to dot because -> used in blade
//  take current value
//*//
class BannerEdit extends Banner implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::updateAttribute("link", 'text', __("Линк для банера")),

            NestedContainer::new("__(\"Desktop\")", [
                InputFileTempAttribute::edit("image->ru", "Русский Баннер", "image_ru"),
                InputFileTempAttribute::edit("image->uz", "Узбекский Баннер", "image_uz"),
//                InputFileTempAttribute::edit("image->en", "Английский Баннер", "image_en")
            ]),
            NestedContainer::new("__(\"Мобилка\")", [
                InputFileTempAttribute::edit("image_mobile->ru", "Русский Баннер", "image_mobile_ru"),
                InputFileTempAttribute::edit("image_mobile->uz", "Узбекский Баннер", "image_mobile_uz"),
//                InputFileTempAttribute::edit("image_mobile->en", "Английский Баннер", "image_mobile_en")
            ]),

        ]);
    }
}
