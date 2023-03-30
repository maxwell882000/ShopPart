<?php

namespace App\Domain\Product\Product\Front\Admin\Functions;

use App\Domain\Core\File\Functions\AbstractLivewireFunction;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Product\HeaderText\Entities\HeaderText;
use App\Domain\Product\HeaderText\Front\Dynamic\HeaderKeyValueDynamic;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;
use App\Http\Livewire\Admin\Pages\HeaderKey\HeaderKeyValueDynamicWithoutEntity;

class HeaderTextFunction extends AbstractLivewireFunction
{
    static public function fillObjects(BaseLivewireFactoring $livewireFactoring, $value)
    {
        $livewireFactoring->objects[$value] = [
            "id" => old("headerText->{$value}->id"),
            "text" => old("headerText->{$value}->text"),
        ];
    }


    protected function mapObjectClass():string
    {
        return HeaderText::class;
    }
}
