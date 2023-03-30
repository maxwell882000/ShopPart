<?php

namespace App\Domain\Lenta\Front\Main;

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
use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Lenta\Front\Admin\CustomTable\Actions\LentaDeleteAction;
use App\Domain\Lenta\Front\Admin\CustomTable\Actions\LentaEditAction;
use App\Domain\Lenta\Front\Admin\CustomTable\Tables\LentaTable;

class LentaIndex extends Lenta implements CreateAttributesInterface, TableInFront
{

    public function getLentaRuAttribute(): string
    {
        return TextAttribute::generation($this, $this->text['ru'], true);
    }

    public function getLentaUzAttribute(): string
    {
        return TextAttribute::generation($this, $this->text['uz'], true);
    }

    public function getLentaNumberAttribute(): string
    {
        return TextAttribute::generation($this, $this->product()->count(), true);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new  FileLivewireCreator('Lenta', $this)
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            LentaEditAction::new([$this->id]),
            LentaDeleteAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return LentaTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

            ]
        );
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function getTitle(): string
    {
        return "Лента";
    }
}
