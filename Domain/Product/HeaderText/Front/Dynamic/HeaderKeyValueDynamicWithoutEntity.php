<?php

namespace App\Domain\Product\HeaderText\Front\Dynamic;

use App\Domain\Core\File\Interfaces\LivewirePassVariableToTag;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Product\HeaderText\Entities\HeaderKeyValue;
use App\Domain\Product\HeaderText\Front\CustomTables\HeaderKeyValueTable;
use App\Domain\Product\HeaderText\Interfaces\HeaderKeyInterface;
use App\Domain\Product\Product\Interfaces\ProductInterface;

class HeaderKeyValueDynamicWithoutEntity extends HeaderKeyValue implements TableInFront, LivewirePassVariableToTag
{
    use TableDynamicWithoutEntity;

    protected $fillable = [
        "key_ru",
//        "key_en",
        "key_uz",
        "value_ru",
//        "value_en",
        "key",
        'value',
        "value_uz",
    ];

    public function __construct(array $attributes = [])
    {
        $this->attributes['key_ru'] = $this->getKeyAttribute()['ru']
            ?? $attributes["key_ru"] ?? "";
//        $this->attributes['key_en'] = $this->getKeyAttribute()['en']
//            ?? $attributes["key_en"] ?? "";
        $this->attributes['key_uz'] = $this->getKeyAttribute()['uz']
            ?? $attributes["key_uz"] ?? "";
        $this->attributes['value_ru'] = $this->getValueAttribute()['ru']
            ?? $attributes["value_ru"] ?? "";
//        $this->attributes['value_en'] = $this->getValueAttribute()['en']
//            ?? $attributes["value_en"] ?? "";
        $this->attributes['value_uz'] = $this->getValueAttribute()['uz']
            ?? $attributes["value_uz"] ?? "";
        parent::__construct($attributes);

    }



//    public function getKeyUzAttribute()
//    {
//        return $this->getKeyAttribute()['uz'];
//    }
//
//    public function getKeyEnAttribute()
//    {
//        return $this->getKeyAttribute()['en'];
//    }
//
//    public function getKeyRuAttribute():string
//    {
//        $s  = json_decode($this->attributes['key']);
//        return $s->ru;
//    }

//    public function getKeyRuAttribute()
//    {
//        return $this->getKeyAttribute()['ru'];
//    }
//
//    public function getValueUzAttribute()
//    {
//        return $this->getValueAttribute()['uz'];
//    }
//
//    public function getValueEnAttribute()
//    {
//        return $this->getValueAttribute()['en'];
//    }

//    public function getValueRuAttribute()
//    {
//        return $this->getValueAttribute()['ru'];
//    }

    public function getCustomFrontRules(): array
    {
        return [
            'key_ru' => null,
            "key_uz" => null,
//            "key_en" => null,
            'value_ru' => null,
            "value_uz" => null,
//            "value_en" => null,
        ];
    }

    public static function getCustomRules(): array
    {
        return [
            'key_ru' => DynamicAttributes::INPUT,
            "key_uz" => DynamicAttributes::INPUT,
//            "key_en" => DynamicAttributes::INPUT,
            'value_ru' => DynamicAttributes::INPUT,
            "value_uz" => DynamicAttributes::INPUT,
//            "value_en" => DynamicAttributes::INPUT,
        ];
    }


    static public function getPrefixInputHidden(): string
    {
        return ProductInterface::HEADER_TEXT_TO . '%s->' . HeaderKeyInterface::KEY_VALUE_SERVICE;
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            VariableGenerator::new(['index'])
        ]);
    }

    public function getTitle(): string
    {
        return "Значения";
    }

    public function getTableClass(): string
    {
        return HeaderKeyValueTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function generateAdditionalToHtml(): array
    {
        return [
            'index',
            "wire:key" => 'index ."header_value_dynamic"'
        ];
    }

}
