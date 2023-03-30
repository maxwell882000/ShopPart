<?php

namespace App\Domain\User\Front\AdminMain;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ContainerTextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Builders\AdminBuilder;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\CustomTable\Action\AdminEditAction;
use App\Domain\User\Front\Admin\CustomTable\Tables\AdminTable;
use App\Domain\User\Interfaces\Roles;

class AdminIndex extends User implements TableInFront, CreateAttributesInterface, Roles
{
    public function newEloquentBuilder($query): AdminBuilder
    {
        return new AdminBuilder($query);
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, 'phone');
    }

    public function getStatusIndexAttribute()
    {
        $class = "bg-blue-400 text-white";
        if ($this->role == self::NOT_ADMIN) {
            $class = "bg-red-400 text-white";
        }
        return ContainerTextAttribute::generation($class, new TextAttribute(
            $this,
            self::DB_TO_FRONT[$this->role],
            true));
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("AdminIndex", $this),
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
            AdminEditAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return AdminTable::class;
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
        return "Админы";
    }


}
