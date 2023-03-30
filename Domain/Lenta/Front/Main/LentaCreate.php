<?php

namespace App\Domain\Lenta\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireNestedWithoutEntity;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Lenta\Front\Admin\DropDown\SideDropDown;
use App\Domain\Product\Product\Front\Nested\ProductNested;

class LentaCreate extends Lenta implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("text", "Введите название"),
            new   FileLivewireNestedWithoutEntity("LentaCreate", ProductNested::generateWithoutEntity(
                self::PRODUCT_SERVICE,
                "Укажите продукт"
            )),
            SideDropDown::new(),
            NestedContainer::new("__(\"Картинка\")", [
                new InputFileTempAttribute("left_image->ru", "Русский"),
                new InputFileTempAttribute("left_image->uz", "Узбекский"),
//                new InputFileTempAttribute("left_image->en", "Английский"),
            ]),
        ]);
    }
}
