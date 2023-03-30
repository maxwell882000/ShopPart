<?php

namespace App\Domain\Category\Front\Main;

use App\Domain\Category\Entities\Category;

use App\Domain\Category\Front\Admin\CustomTable\Action\Models\CategoryDeleteAction;
use App\Domain\Category\Front\Admin\CustomTable\Action\Models\CategoryEditAction;
use App\Domain\Category\Front\Admin\CustomTable\Tables\CategoryTable;
use App\Domain\Category\Front\Traits\CategoryAttributeTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\DropDown\Models\Paginator\PaginatorDropDown;
use App\Domain\Core\Front\Admin\DropDown\OptionalItems\ActivateChooseItem;
use App\Domain\Core\Front\Admin\DropDown\OptionalItems\DeactivateChooseItem;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;


use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\OpenButton\Interfaces\FilterInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Traits\ArrayHandle;


class CategoryIndex extends Category implements TableInFront, CreateAttributesInterface
{
    use  CategoryAttributeTable, TableFilterBy, AttributeGetVariable;

//    write all mutators required for table
//    add title for indexPage
//    addButton function and route to create new object
//    addFiltration which are required
//


    public function getNameTableAttribute(): string
    {
        return TextAttribute::generation($this, $this['name_current'], true);
    }

    // call function which will have set of actions for this table
    public function getActionsAttribute(): string
    {
        return (new AllActions(
            [
                new CategoryEditAction([$this->id]),
                new CategoryDeleteAction([$this->id])
            ]
        ))->generateHtml();
    }

    /// this table will be shared to livewire where it will be initiated
    public function getTableClass(): string
    {
        return CategoryTable::class;
    }

    public function getTitle(): string
    {
        return "Категории";
    }

    public function livewireComponents(): LivewireComponents
    {
        return new AllLivewireComponents([
        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return new AllLivewireOptionalDropDown([
            ActivateChooseItem::create('status'),
            DeactivateChooseItem::create('status')
        ]);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("CategoryIndex", $this)
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    function filterByData(): array
    {
        return [
            "depth" => 1,
            'order_by_order' => true
        ];
    }
}
