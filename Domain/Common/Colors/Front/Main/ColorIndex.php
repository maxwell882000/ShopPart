<?php

namespace App\Domain\Common\Colors\Front\Main;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Common\Colors\Front\Admin\CustomTable\Actions\ColorDeleteAction;
use App\Domain\Common\Colors\Front\Admin\CustomTable\Actions\ColorEditAction;
use App\Domain\Common\Colors\Front\Admin\CustomTable\Table\ColorTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class ColorIndex extends Color implements TableInFront, CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("Color", $this)
        ]);
    }

    public function getColorIndexAttribute()
    {
        return TextAttribute::generation($this, "color_current");
    }

    public function getTableClass(): string
    {
        return ColorTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([]);
    }

    public function getTitle(): string
    {
        return "Цвета";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ColorEditAction::new([$this->id]),
            ColorDeleteAction::new([$this->id])
        ]);
    }
}
