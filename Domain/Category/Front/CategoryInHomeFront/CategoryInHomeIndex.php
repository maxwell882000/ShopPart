<?php

namespace App\Domain\Category\Front\CategoryInHomeFront;

use App\Domain\Category\Entities\CategoryInHome;
use App\Domain\Category\Front\Admin\CustomTable\Action\Models\CategoryInHomeDeleteAction;
use App\Domain\Category\Front\Admin\CustomTable\Action\Models\CategoryInHomeEditAction;
use App\Domain\Category\Front\Admin\CustomTable\Tables\CategoryInHomeTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
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

class CategoryInHomeIndex extends CategoryInHome implements TableInFront, CreateAttributesInterface
{
    public function getIconTableAttribute(): string
    {
        return ImageAttribute::generation($this, 'icon_value');
    }

    public function getIconValueAttribute(): string
    {
        if ($this->category->icon)
            return $this->category->icon->icon->storage();
        return "";
    }

    public function getColorIndexAttribute()
    {

        return Container::new([
            'style' => "background-color:$this->color;padding:20px"
        ], [])->generateHtml();
    }

    public function getBackColorIndexAttribute()
    {

        return Container::new([
            'style' => "background-color:$this->back_color;padding:20px"
        ], [])->generateHtml();
    }

    public function getNameTableAttribute(): string
    {
        return TextAttribute::generation($this, $this->category->name_current, true);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return new  AllLivewireFunctions([]);
    }

    public function getActionsAttribute(): string
    {

        return (new AllActions(
            [
                new CategoryInHomeEditAction([$this->category_id]),
                new CategoryInHomeDeleteAction([$this->category_id])
            ]
        ))->generateHtml();
    }

    public function getTableClass(): string
    {
        return CategoryInHomeTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([]);
    }

    public function getTitle(): string
    {
        return "Категории в начальной странице";
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("CategoryInHomeIndex", $this)
        ]);
    }
}
