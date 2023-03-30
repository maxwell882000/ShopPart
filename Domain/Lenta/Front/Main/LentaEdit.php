<?php

namespace App\Domain\Lenta\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireNested;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Lenta\Front\Admin\DropDown\SideDropDown;
use App\Domain\Product\Product\Front\Nested\ProductNested;

class LentaEdit extends Lenta implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("text", "Введите название", false),
            new FileLivewireNested("LentaEdit", ProductNested::generate(
                self::PRODUCT_ACCEPT,
                "Укажите продукт",
                'lenta_id'
            )),
            SideDropDown::new(false),
            NestedContainer::new("__(\"Картинка\")", [
                InputFileTempAttribute::edit("left_image->ru", "Русский", "left_image_ru"),
                InputFileTempAttribute::edit("left_image->uz", "Узбекский", "left_image_uz"),
//                InputFileTempAttribute::edit("left_image->en", "Английский", "left_image_en"),
            ]),
        ]);
    }
}
