<?php

namespace App\Domain\Product\Product\Front\ComplexFactoring;

use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangWithoutAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\ComplexFactoring;
use App\Domain\Product\HeaderText\Front\Dynamic\HeaderKeyValueDynamic;
use App\Domain\Product\HeaderText\Front\Dynamic\HeaderKeyValueDynamicWithoutEntity;
use App\Domain\Product\HeaderText\Interfaces\HeaderKeyInterface;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

class HeaderTextFactoring implements ComplexFactoring, ProductInterface, HeaderKeyInterface
{

    static public function initialize(BaseLivewireFactoring $factoring)
    {
        foreach ($factoring->entity->headerText()->orderBy("id")->get() as $key) {
            $factoring->entities[$factoring->counter] = $key;
            $factoring->counter++;
        }
    }

    static public function delete(BaseLivewireFactoring $factoring, $id)
    {
        // TODO: Implement delete() method.
    }

    static public function create(): array
    {
        return [
            Container::new([
                "class" => "w-full",
                'wire:key' => 'super_key_edit.{{$index}}.god_of',
            ], [
                new InputLangWithoutAttribute(
                    sprintf(self::SET_ENTITY_WITHOUT, "text"),
                    sprintf(self::SET_NAME, self::HEADER_TEXT_TO, "text"),
                    sprintf(self::SET_NAME_WITHOUT, self::HEADER_TEXT_TO, "text"),
                    "Название заголовка"),
                self::container(HeaderKeyValueDynamicWithoutEntity::getDynamicWithoutContainer("HeaderKey"))
            ]),

        ];
    }

    static private function container($header)
    {
        return ModalCreator::new(
            ButtonDaisy::new("Значения", [
                '@click' => "open()",
                "wire:key" => sprintf(self::SET_NAME, "header_text", "modal"),
                "class" => "self-start mt-4 btn-sm btn-accent"
            ]),
            ModalContainer::new([], [
                Container::new([
                    "@click.away" => "show = false",
                    "class" => "rounded"
                ], [
                    BoxTitleContainer::newTitle("Значения", "rounded", [
                        $header
                    ])
                ])
            ]),
            [
                'class' => "flex flex-row justify-start"
            ]
        );
    }

    static public function edit(): array
    {
        return [
            Container::new(
                [
                    "class" => "w-full",
                    'wire:key' => 'super_key_edit.{{$index}}.somehting',
                ],
                [
                    new InputLangWithoutAttribute(
                        sprintf(self::SET_ENTITY_WITHOUT, "text"),
                        sprintf(self::SET_NAME, self::HEADER_TEXT_TO, "text"),
                        sprintf(self::SET_NAME_WITHOUT, self::HEADER_TEXT_TO, "text"),
                        "Название заголовка"),
                    self::container(HeaderKeyValueDynamic::getDynamicWithoutContainer("HeaderEdit", "pivot->id"))
                ]
            )

        ];
    }
}
