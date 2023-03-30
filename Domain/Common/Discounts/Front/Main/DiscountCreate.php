<?php

namespace App\Domain\Common\Discounts\Front\Main;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Core\File\Models\Livewire\FileLivewireNestedWithoutEntity;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Product\Product\Front\Nested\ProductNested;

class DiscountCreate extends Discount implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::createAttribute("percent", "number", "Процент скидки"),
            NestedContainer::new("__(\"Скидки для Мобилки\")", [
                new InputFileTempAttribute("mob_image->ru", "Русский Баннер"),
                new InputFileTempAttribute("mob_image->uz", "Узбекский Баннер"),
                new InputFileTempAttribute("mob_image->en", "Английский Баннер"),
            ]),
            NestedContainer::new("__(\"Скидки для Вэб\")", [
                new InputFileTempAttribute("des_image->ru", "Русский Баннер"),
                new InputFileTempAttribute("des_image->uz", "Узбекский Баннер"),
                new InputFileTempAttribute("des_image->en", "Английский Баннер")
            ]),
            new FileLivewireNestedWithoutEntity("DiscountCreate", $this->getProductNested())
        ]);
    }

    public function getProductNested()
    {
        return ProductNested::generateWithoutEntity(
            self::PRODUCT_SERVICE,
            'Укажите продукты'
        );
    }
}
