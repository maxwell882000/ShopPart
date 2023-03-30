<?php

namespace App\Domain\Product\Product\Front\Main;

use App\Domain\Category\Front\Admin\DropDown\CategoryDropDownSearch;
use App\Domain\Common\Brands\Front\Admin\DropDown\BrandDropDownSearch;
use App\Domain\Core\File\Models\Livewire\FileLivewireFactoring;
use App\Domain\Core\File\Models\Livewire\FileLivewireNestedWithoutEntity;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempManyAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Front\Js\Interfaces\FilterJsInterface;
use App\Domain\CreditProduct\Front\Nested\MainCreditNested;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Admin\Attributes\HeaderTextAttribute;
use App\Domain\Product\Product\Front\Admin\Attributes\KeyWithMultipleValueAttribute;
use App\Domain\Product\Product\Front\Admin\DropDown\CurrencyDropDown;
use App\Domain\Product\Product\Front\ComplexFactoring\ColorComplexFactoring;
use App\Domain\Product\Product\Front\ComplexFactoring\HeaderTextFactoring;
use App\Domain\Product\Product\Front\ComplexFactoring\KeyWithMultipleValue;
use App\Domain\Shop\Front\Admin\DropDown\ShopDropDownSearch;

class ProductCreate extends Product implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            CategoryDropDownSearch::newCat(),
            ShopDropDownSearch::newShop(),
            BrandDropDownSearch::newBrand(),
            new InputLangAttribute("title", "Введите название"),
            InputAttribute::createAttribute("number", "number", "Введите количество данного товара"),
            CurrencyDropDown::new(),
            InputAttribute::createAttribute("price", "number", "Введите цену"),
            InputAttribute::createAttribute("percentage", "text", "Укажите скидку" . " (%)",
                "percentage", "", FilterJsInterface::ONLY_NUMBER),
            InputAttribute::createAttribute("weight", "number", "Введите вес"),
            InputAttribute::createAttribute(
                self::PRODUCT_DAY_TO . "checked",
                "checkbox",
                __("Продукт дня")),
            InputAttribute::createAttribute(
                self::PRODUCT_HIT_TO . "checked",
                "checkbox",
                __("Хит продаж")),
            InputFileTempAttribute::create(self::CARD_IMAGE_TO . "image", "Главная картинка"),
            InputFileTempManyAttribute::create(self::IMAGE_TO . "image", "Картинки"),
            new  FileLivewireNestedWithoutEntity("ProductCreate", $this->getMainCredit()),
            NestedContainer::new("__(\"Большое описание\")", [
                new InputLangAttribute(self::DESCRIPTION_TO . "header", "Введите заголовок"),
                new TextAreaLangAttribute(self::DESCRIPTION_TO . 'body', "Введите описание")
            ], [
                "class" => "space-y-4"
            ]),
            KeyWithMultipleValueAttribute::new(KeyWithMultipleValue::create()),
            FileLivewireFactoring::generation("Product",
                $this, [], "Цвета",
                ColorComplexFactoring::create(), [],
                self::COLORS_SERVICE),
            HeaderTextAttribute::new(HeaderTextFactoring::create()),
        ]);
    }

    public function getMainCredit()
    {
        return MainCreditNested::generateWithoutEntity(
            self::MAIN_CREDIT_SERVICE,
            "Добавьте виды рассрочки для продукта",
        );
    }
}
