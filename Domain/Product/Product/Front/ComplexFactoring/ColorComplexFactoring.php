<?php

namespace App\Domain\Product\Product\Front\ComplexFactoring;

use App\Domain\Common\Colors\Front\Admin\DropDown\ColorDropDownSearch;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempManyAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\ComplexFactoring;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

class ColorComplexFactoring implements ComplexFactoring, ProductInterface
{

    static public function initialize(BaseLivewireFactoring $factoring)
    {
        foreach ($factoring->entity->colors as $color) {
            $factoring->entities[$factoring->counter] = $color;
            $factoring->counter++;
        }
    }

    static public function delete(BaseLivewireFactoring $factoring, $id)
    {

        $object = $factoring->entities->pull($id);
        $factoring->entity->colors()->where("id", "=", $object['id'])->delete();
    }

    static public function create(): array
    {
        return [
            ColorDropDownSearch::newColor(true, [], [
                'wire:key' => 'new_drop_objects.{{$index}}.color_id',
                'prefix' => sprintf('%s{{$index}}%s', ProductInterface::COLORS_TO, \CR::CR),
            ]),
            InputFileTempAttribute::create(self::COLORS_TO .
                sprintf('%%s%simage', \CR::CR),
                "Главный цвет",
                'new_product_file_objects.{{$index}}.file_one',
                self::INDEX
            ),
            InputFileTempManyAttribute::create(self::COLORS_TO .
                sprintf('%%s%simages', \CR::CR),
                "Под цвета",
                'new_product_file_objects.{{$index}}.file_two',
                self::INDEX),
        ];
    }

    static public function edit(): array
    {
        return [
            ColorDropDownSearch::newColor(false, [], [
                'wire:key' => 'edit_drop_objects.{{$index}}.color_id',
                'prefix' => sprintf('%s{{$index}}%s', ProductInterface::COLORS_TO, \CR::CR),
            ]),
            InputFileTempAttribute::edit(self::COLORS_TO .
                sprintf('%%s%simage', \CR::CR),
                "Главный цвет",
                'image',
                'edit_product_file_objects.{{$index}}.file_one',
                self::INDEX,
                ""
            ),
            InputFileTempManyAttribute::edit(self::COLORS_TO .
                sprintf('%%s%simages', \CR::CR),
                "Под цвета",
                'images',
                'edit_product_file_objects.{{$index}}.file_two',
                self::INDEX),
        ];
    }
}
