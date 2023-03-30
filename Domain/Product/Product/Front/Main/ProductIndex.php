<?php

namespace App\Domain\Product\Product\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\File\Models\Main\FileBladeCreatorIndex;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Interfaces\AttributeInterface;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Admin\CustomTable\Actions\ProductDeleteAction;
use App\Domain\Product\Product\Front\Admin\CustomTable\Actions\ProductEditAction;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductTable;
use App\Domain\Product\Product\Front\Traits\ProductCommonTableAttributes;

class ProductIndex extends Product implements TableInFront, CreateAttributesInterface
{
   use ProductCommonTableAttributes;

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("Product", $this),
        ]);
    }

    public function getTableClass(): string
    {
        return ProductTable::class;
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
        return "Товары";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ProductEditAction::new([$this->id]),
            ProductDeleteAction::new([$this->id]),
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
