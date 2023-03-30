<?php

namespace App\Domain\Shop\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\OpenAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Front\Admin\CustomTable\Actions\ShopDeleteAction;
use App\Domain\Shop\Front\Admin\CustomTable\Actions\ShopEditAction;
use App\Domain\Shop\Front\Admin\CustomTable\Tables\ShopTable;

class ShopIndex extends Shop implements TableInFront, CreateAttributesInterface
{
    public function getLogoIndexAttribute(): string
    {
        return ImageAttribute::generation($this, $this->logo->storage(), true);
    }

    public function getNameIndexAttribute()
    {
        return TextAttribute::generation($this, "name");
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, $this->user->phone, true);
    }

    public function getProductIndexAttribute()
    {
        return TextAttribute::generation($this, "asd", true);
    }

    public function getTableClass(): string
    {
        return ShopTable::class;
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

    public function getTitle(): string
    {
        return "Магазин";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ShopEditAction::new([$this->id]),
            ShopDeleteAction::new([$this->id])
        ]);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("Shop", $this)
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
