<?php

namespace App\Domain\Common\Brands\Front\Main;

use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Common\Brands\Front\Admin\CustomTable\Actions\BrandDeleteAction;
use App\Domain\Common\Brands\Front\Admin\CustomTable\Actions\BrandEditAction;
use App\Domain\Common\Brands\Front\Admin\CustomTable\Models\BrandTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class BrandIndex extends Brand implements CreateAttributesInterface, TableInFront
{
    public function getBrandIndexAttribute(): string
    {
        return TextAttribute::generation($this, "brand");
    }

    public function getLogoIndexAttribute(): string
    {
        return ImageAttribute::generation($this, $this->image->storage(), true);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation(
            [
                new FileLivewireCreator("Brand", $this)
            ]
        );
    }

    public function getTableClass(): string
    {
        return BrandTable::class;
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

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getTitle(): string
    {
        return "Брэнд";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation(
            [

                BrandEditAction::new([$this->id]),
                BrandDeleteAction::new([$this->id]),
            ]
        );
    }
}
