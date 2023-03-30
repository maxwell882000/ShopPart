<?php

namespace App\Domain\Common\Banners\Front\Main;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class BannerCreate extends Banner implements CreateAttributesInterface
{
    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::createAttribute("link", 'text', __("Линк для банера")),
            NestedContainer::new("__(\"Desktop\")", [
                new InputFileTempAttribute("image->ru", "Русский Баннер"),
                new InputFileTempAttribute("image->uz", "Узбекский Баннер"),
//                new InputFileTempAttribute("image->en", "Английский Баннер"),
            ]),
            NestedContainer::new("__(\"Мобилка\")", [
                new InputFileTempAttribute("image_mobile->ru", "Русский Баннер"),
                new InputFileTempAttribute("image_mobile->uz", "Узбекский Баннер"),
//                new InputFileTempAttribute("image_mobile->en", "Английский Баннер"),
            ])

        ]);
    }
}
