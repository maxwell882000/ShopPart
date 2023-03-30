<?php

namespace App\Domain\Policies\Front\Main;

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
use App\Domain\Policies\Entity\Policy;
use App\Domain\Policies\Front\Admin\CustomTable\Actions\PolicyDeleteAction;
use App\Domain\Policies\Front\Admin\CustomTable\Actions\PolicyEditAction;
use App\Domain\Policies\Front\Admin\CustomTable\Tables\PolicyTable;

class PolicyIndex extends Policy implements TableInFront, CreateAttributesInterface
{
    public function getIdIndexAttribute()
    {
        return TextAttribute::generation($this, "id");
    }

    public function getPoliciesIndexUzAttribute()
    {
        return TextAttribute::generation($this, substr($this->policies['uz'] ?? '', 0, 30), true);
    }

    public function getPoliciesIndexRuAttribute()
    {
        return TextAttribute::generation($this, substr($this->policies['ru'] ?? '', 0, 30), true);
    }

    public function getPoliciesIndexEnAttribute()
    {
        return TextAttribute::generation($this, substr($this->policies['en'] ?? '', 0, 30), true);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getActionsAttribute(): string
    {
//        dd($this->id);
        return AllActions::generation([
            PolicyEditAction::new([$this->id]),
            PolicyDeleteAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return PolicyTable::class;
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
        return "Политика и Конфеденциальность";
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("PolicyIndex", $this)
        ]);
    }
}
