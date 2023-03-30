<?php

namespace App\Domain\Shop\Front\Main;


use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Front\Admin\DropDown\ShopAvailableCitiesDropDownSearch;
use App\Domain\Shop\Front\Dynamic\WorkTimesDynamicWithoutEntity;

class ShopCreate extends Shop implements CreateAttributesInterface
{
    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::init("name", "text", "Никнейм"),
            new InputAttribute("name", "text", "Имя Магазина"),
            new InputAttribute(self::USER_TO . "phone", "text", "Телефон пользователя"),
            new InputAttribute(self::USER_TO . "password", "password", "Пароль"),
            new InputFileTempAttribute("image_in_cart", "Фото магазина в карточке"),
            new InputFileTempAttribute("image", "Фото магазина"),
            new InputFileTempAttribute("logo", "Лого Магазина"),
            new InputFileTempAttribute("document", "Документы"),
            new InputFileTempAttribute("licence", "Лицензия"),
            new InputFileTempAttribute("director_passport", "Паспорт директора"),
            NestedContainer::new("__(\"Адрес\")", [
                ShopAvailableCitiesDropDownSearch::newCities(),
                Container::new([
                    'class' => 'flex flex-wrap justify-between items-around'
                ], [
                    InputAttribute::createAttribute(self::SHOP_ADDRESS_TO . "longitude",
                        "number",
                        "Долгота"),
                    InputAttribute::createAttribute(self::SHOP_ADDRESS_TO . "latitude",
                        "number",
                        "Широта"),
                    InputAttribute::createAttribute(self::ADDRESS_TO_DELIVERY_TO . "index",
                        "number", "Индекс"),
                    InputAttribute::createAttribute(self::ADDRESS_TO_DELIVERY_TO . "street",
                        "text", "Улица"),
                    InputAttribute::createAttribute(self::ADDRESS_TO_DELIVERY_TO . 'house',
                        "number", "Номер дома"),
                ]),
                new TextAreaAttribute(self::ADDRESS_TO_DELIVERY_TO . "instructions",
                    "Инструкции для курьера"),
                WorkTimesDynamicWithoutEntity::getDynamic("ShopCreate")
            ], [
                'class' => "space-y-5",
            ])
        ]);
    }
}
