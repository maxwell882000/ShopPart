<?php

namespace App\Domain\Common\Discounts\Front\Main;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Core\File\Models\Livewire\FileLivewireNested;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Product\Product\Front\Nested\ProductNested;

class DiscountEdit extends Discount implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::createAttribute("percent", "number", "Процент скидки"),
            NestedContainer::new("__(\"Скидки для Мобилки\")", [
                InputFileTempAttribute::edit("mob_image->ru",
                    "Русский Баннер",
                    "mob_image_ru"),
                InputFileTempAttribute::edit("mob_image->uz",
                    "Узбекский Баннер",
                    "mob_image_uz"),
                InputFileTempAttribute::edit("mob_image->en",
                    "Английский Баннер",
                    "mob_image_en"),
            ]),
            NestedContainer::new("__(\"Скидки для Вэб\")", [
                InputFileTempAttribute::edit("des_image->ru",
                    "Русский Баннер",
                    "des_image_ru"),
                InputFileTempAttribute::edit("des_image->uz",
                    "Узбекский Баннер",
                    "des_image_uz"),
                InputFileTempAttribute::edit("des_image->en",
                    "Английский Баннер",
                    "des_image_en")
            ]),
            new FileLivewireNested("DiscountEdit", $this->getProductNested())
        ]);
    }

    public function getProductNested()
    {
        return ProductNested::generate(
            "acceptProduct",
            'Укажите продукты',
            "discount_id");
    }
}
