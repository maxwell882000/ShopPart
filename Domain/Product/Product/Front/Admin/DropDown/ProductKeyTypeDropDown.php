<?php

namespace App\Domain\Product\Product\Front\Admin\DropDown;

use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\ComplexFactoringConstants;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\ProductKey\Interfaces\ProductKeyInterface;

class ProductKeyTypeDropDown extends BaseDropDownAttribute implements ComplexFactoringConstants, ProductInterface
{
    public function __construct(array $items, $name = null, $index = null)
    {
        parent::__construct($items, $name);
        $this->entity_key = 'type';
        $this->key = self::PRODUCT_KEY_TO . $index . '->type';
    }

    function setType(): string
    {
        return "number";
    }

    function setKey(): string
    {
        return sprintf(self::SET_NAME, self::PRODUCT_KEY_TO, "type");
    }

    function setName(): string
    {
        return __("Выберите тип");
    }

    static public function getDropDown($name = null, $index = null): AbstractDropDown
    {
        return new self([
            new DropItem(ProductKeyInterface::TYPE_CHOICE, ProductKeyInterface::DB_TO_FRONT[ProductKeyInterface::TYPE_CHOICE]),
            new DropItem(ProductKeyInterface::TYPE_LIST, ProductKeyInterface::DB_TO_FRONT[ProductKeyInterface::TYPE_LIST])
        ], ProductKeyInterface::DB_TO_FRONT[$name] ?? null, $index);
    }

    public function generateHtml(): string
    {
        return sprintf("
        <div @choose-choice=\" console.log(isNotPrice);isNotPrice = !!parseInt(\$event.detail);\">
                <x-helper.drop_down.drop_down :drop='%s' %s/>
        </div>
        ",
            $this->initGetDropDown(
                $this->getWithoutScopeAtrVariable($this->entity_key ?? $this->key),
                '$index'
            ),
            $this->generateAttributes()
        );
    }
}
