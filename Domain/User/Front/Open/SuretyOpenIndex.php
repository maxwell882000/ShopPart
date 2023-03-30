<?php

namespace App\Domain\User\Front\Open;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Front\Admin\CustomTable\Action\SuretyDeleteAction;
use App\Domain\User\Front\Admin\CustomTable\Action\SuretyEditAction;
use App\Domain\User\Front\Admin\CustomTable\Tables\SuretyTable;

class SuretyOpenIndex extends Surety implements TableInFront, CreateAttributesInterface
{
    use TableFilterBy, ArrayHandle;


    public function getNameIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->crucialData->name, true);
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, $this->phone, true);
    }


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy($this->class_name, $this),
        ]);
    }

    function filterByData(): array
    {
        return [
            'user_id' => '$params'
        ];
    }

    public function getTableClass(): string
    {
        return SuretyTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation(
            [

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
        return 'Поручители';
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            SuretyEditAction::new([$this->id]),
            SuretyDeleteAction::new([$this->id])
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
