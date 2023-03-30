<?php

namespace App\Domain\Product\Product\Front\Main;

use App\Domain\Category\Front\Admin\DropDown\CategoryDropDownSearch;
use App\Domain\Common\Brands\Front\Admin\DropDown\BrandDropDownSearch;
use App\Domain\Core\File\Models\Livewire\FileLivewireFactoring;
use App\Domain\Core\File\Models\Livewire\FileLivewireNested;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Attributes\Excel\ExcelAttribute;
use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\CreditProduct\Front\Nested\MainCreditNested;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Admin\Attributes\HeaderTextAttribute;
use App\Domain\Product\Product\Front\Admin\Attributes\KeyWithMultipleValueAttribute;
use App\Domain\Product\Product\Front\Admin\DropDown\CurrencyDropDown;
use App\Domain\Product\Product\Front\ComplexFactoring\ColorComplexFactoring;
use App\Domain\Product\Product\Front\ComplexFactoring\HeaderTextFactoring;
use App\Domain\Product\Product\Front\ComplexFactoring\KeyWithMultipleValue;
use App\Domain\Shop\Front\Admin\DropDown\ShopDropDownSearch;

class ProductEdit extends Product implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            CategoryDropDownSearch::newCat(false),
            ShopDropDownSearch::newShop(false),
            BrandDropDownSearch::newBrand(false),
            new InputLangAttribute("title", __("Введите название"), false),
            InputAttribute::updateAttribute("number", "number", __("Введите количество данного товара")),
            CurrencyDropDown::new(false),
            InputAttribute::updateAttribute("price", "number", __("Введите цену")),
            InputAttribute::updateAttribute("percentage", "number", __("Укажите скидку") . " (%)"),
            InputAttribute::updateAttribute("weight", "number", __("Введите вес(кг)")),
            InputAttribute::updateAttribute(
                self::PRODUCT_DAY_TO . "checked",
                "checkbox",
                __("Продукт дня")),
            InputAttribute::updateAttribute(
                self::PRODUCT_HIT_TO . "checked",
                "checkbox",
                __("Хит продаж")),
            new InputFileAttribute(
                "image_main",
                "Главная картинка",
                self::class,
                true
            ),
            new InputFileAttribute(
                "image_product",
                "Картинки для товара",
                self::class,
                true,
                true
            ),
            new FileLivewireNested("ProductEdit", $this->getMainCredit()),
            NestedContainer::new("__(\"Большое описание\")", [
                new InputLangAttribute(self::DESCRIPTION_TO . "header", "Введите заголовок", false),
                new TextAreaLangAttribute(self::DESCRIPTION_TO . 'body', "Введите описание", false)
            ], [
                "class" => "space-y-4"
            ]),
            KeyWithMultipleValueAttribute::new(
                KeyWithMultipleValue::create(),
                KeyWithMultipleValue::edit(),
                KeyWithMultipleValue::class,
                "ProductEdit",
                new ExcelAttribute("product_keys")
            ),
            FileLivewireFactoring::generation("ProductEdit",
                $this, [], "Цвета",
                ColorComplexFactoring::create(), ColorComplexFactoring::edit(),
                self::COLORS_SERVICE, ColorComplexFactoring::class),
            HeaderTextAttribute::new(
                HeaderTextFactoring::create(),
                HeaderTextFactoring::edit(),
                HeaderTextFactoring::class,
                "ProductEdit",
                new ExcelAttribute("header_text")
            )
        ]);
    }

    public function getMainCredit()
    {
        return MainCreditNested::generate(
            "acceptMainCredit",
            "Добавьте виды рассрочки для продукта",
            "product_id"
        );
    }


    public function getImageMainAttribute(): FileAttribute
    {
        return new FileAttribute(
            $this[self::CARD_IMAGE_SERVICE],
            "image",
            "product_2"
        );
    }


}
