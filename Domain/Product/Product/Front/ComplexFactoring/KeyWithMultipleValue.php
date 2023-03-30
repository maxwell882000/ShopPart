<?php

namespace App\Domain\Product\Product\Front\ComplexFactoring;

use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangWithoutAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputPureAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\ComplexFactoring;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Product\Product\Front\Admin\DropDown\ProductKeyTypeDropDown;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use App\Domain\Product\ProductKey\Front\Dynamic\ProductValueDynamic;
use App\Domain\Product\ProductKey\Front\Dynamic\ProductValueDynamicWithoutEntity;
use App\Domain\Product\ProductKey\Front\Dynamic\ProductValueDynamicWithPriceWithoutEntity;
use App\Domain\Product\ProductKey\Front\Dynamic\ProductValueWithPriceDynamic;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

class KeyWithMultipleValue implements ComplexFactoring, ProductInterface
{
    use AttributeGetVariable;

    static public function initialize(BaseLivewireFactoring $factoring)
    {
        foreach ($factoring->entity->productKey as $key) {
            $factoring->entities[$factoring->counter] = $key;
            $factoring->counter++;
        }
    }

    static public function delete(BaseLivewireFactoring $factoring, $id)
    {
        $object = $factoring->entities->pull($id);
        try {
            ProductKey::find($object['id'])->delete();
        } catch (\Exception $exception) {
            $factoring->entity->productKey()->detach($object['id']);
        }
    }

    static private function inputs($create = true)
    {
        return Container::new([
            'class' => 'flex flex-row space-between items-end mb-4'
        ], [
            new InputLangWithoutAttribute(
                sprintf(self::SET_ENTITY_WITHOUT, "text"),
                sprintf(self::SET_NAME, self::PRODUCT_KEY_TO, "text"),
                sprintf(self::SET_NAME_WITHOUT, self::PRODUCT_KEY_TO, "text"),
                "Название заголовка"),
            Container::new([
                'class' => 'w-max ',
            ], [
                ProductKeyTypeDropDown::new($create),
            ]),
        ]);
    }

    static public function create(): array
    {
        return [
            Container::new([
                'class' => 'w-full',
                'x-data' => '{ isNotPrice: true }',
                'wire:key' => 'super_key.{{$index}}.unique',
            ], [
                IFstatement::new(
                    self::ENTITY . " && "
                    . sprintf(self::SET_ENTITY_NOT_SCOPE, "id")),
                InputPureAttribute::new([
                    'class' => "hidden",
                    "name" => sprintf(self::SET_NAME, self::PRODUCT_KEY_TO, "id"),
                    "value" => sprintf(self::SET_ENTITY, "id ?? 0"),
                ]),
                ENDIFstatement::new(),
                self::inputs(),
                Container::new([
                    'x-show' => 'isNotPrice'
                ], [
                    ProductValueDynamicWithoutEntity::getDynamic("KeyWithMultipleValue"),
                ]),
                Container::new([
                    'x-show' => '!isNotPrice'
                ], [
                    ProductValueDynamicWithPriceWithoutEntity::getDynamic("KeyWithMultipleValueWithPrice"),
                ]),
            ]),
        ];
    }

    static public function edit(): array
    {
        return [
            Container::new([
                'class' => 'w-full',
                'wire:key' => 'super_key_edit.{{$index}}.unique',
                'x-data' => '{ isNotPrice : ' . sprintf(self::SET_ENTITY, "type ?? 0") . ' }',
            ], [
                self::inputs(false),
                Container::new(
                    [
                        'x-show' => '!isNotPrice',
                        'wire:key' => 'super_key_edit.{{$index}}.unique_edit_with_pivot',
                    ],
                    [
                        ProductValueWithPriceDynamic::getDynamic("ProductEdit", "pivot->id")
                    ]
                ),
                Container::new(
                    [
                        'x-show' => 'isNotPrice',
                        'wire:key' => 'super_key_edit.{{$index}}.isNotPrice',

                    ],
                    [
                        ProductValueDynamic::getDynamic("ProductEdit", "pivot->id")
                    ]
                ),
            ]),
        ];
    }
}
