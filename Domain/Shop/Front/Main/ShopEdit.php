<?php

namespace App\Domain\Shop\Front\Main;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Front\Admin\DropDown\ShopAvailableCitiesDropDownSearch;
use App\Domain\Shop\Front\Dynamic\WorkTimesDynamic;

class ShopEdit extends Shop implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputAttribute("name", "text",
                "Имя Магазина", false),
            new InputAttribute(self::USER_TO . "phone", "text",
                "Телефон пользователя", false),
            InputAttribute::createAttribute(self::USER_TO . "password", "password", "Пароль"),
            new InputFileAttribute("image_in_cart_file", "Фото магазина в карточке", self::class),
            new InputFileAttribute("image_file", "Фото магазина", self::class),
            new InputFileAttribute("logo_file", "Лого Магазина", self::class),
            new InputFileAttribute("document_file", "Документы", self::class),
            new InputFileAttribute("licence_file", "Лицензия", self::class),
            new InputFileAttribute("passport_file", "Паспорт директора", self::class),
            NestedContainer::new("__(\"Адрес\")", [
                ShopAvailableCitiesDropDownSearch::newCities(false),
                Container::new([
                    'class' => 'flex flex-wrap justify-between items-around'
                ], [
                    InputAttribute::updateAttribute(self::SHOP_ADDRESS_TO . "longitude",
                        "number",
                        "Долгота"),
                    InputAttribute::updateAttribute(self::SHOP_ADDRESS_TO . "latitude",
                        "number",
                        "Широта"),
                    InputAttribute::updateAttribute(self::ADDRESS_TO_DELIVERY_TO . "index",
                        "number", "Индекс"),
                    InputAttribute::updateAttribute(self::ADDRESS_TO_DELIVERY_TO . "street",
                        "text", "Улица"),
                    InputAttribute::updateAttribute(self::ADDRESS_TO_DELIVERY_TO . 'house',
                        "number", "Номер дома"),
                ]),
                new TextAreaAttribute(self::ADDRESS_TO_DELIVERY_TO . "instructions",
                    "Инструкции для курьера"),
                WorkTimesDynamic::getDynamic("ShopCreate", self::SHOP_ADDRESS_TO . "shop_address_id")
            ], [
                'class' => "space-y-5",
            ])
        ]);
    }

    public function getImageFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "image", "shop_1");
    }

    public function getImageInCartFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "image_in_cart", "shop_1_in_cart");
    }

    public function getLogoFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "logo", "shop_2");
    }

    public function getDocumentFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "document", "shop_3");
    }

    public function getLicenceFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "licence", "shop_4");
    }

    public function getPassportFileAttribute(): FileAttribute
    {
        return new FileAttribute($this, "director_passport", "shop_5");
    }
}
